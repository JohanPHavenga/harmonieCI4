<?php
// get active section from URL
// $segs = $this->uri->segment_array();
// $uri_string = $this->uri->uri_string();
// array_shift($segs);

$uri = current_url(true);
$segs = $uri->getSegments();
array_shift($segs);

$uri_string = $uri->getPath();

// echo $uri_string;
// wts($segs);

if (empty($segs)) {
    $segs[0] = 'dashboard';
}
// if (!isset($segs[2])) { $segs[2]="dashboard"; }

?>

<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

        <?php
        foreach ($menu_array as $section_key => $section) {
            if ($section_key == 0) {
                $s = "start";
            } else {
                $s = '';
            }
            if (in_array($segs[0], $section['seg0'])) {
                $s .= " active open";
            }

            echo "<li class='nav-item $s'>";
            echo "<a href='" . base_url($section['url']) . "' class='nav-link nav-toggle'>";
            echo "<i class='icon-" . $section['icon'] . "'></i>";
            echo "<span class='title'>$section[text]</span>";
            if (in_array($segs[0], $section['seg0'])) {
                echo "<span class='selected'></span><span class='arrow open'></span>";
            }
            echo "</a>";
            if (@$section['submenu']) {
                echo '<ul class="sub-menu">';

                foreach ($section['submenu'] as $page_key => $page) {
                    if ($page_key == 0) {
                        $s = "start";
                    } else {
                        $s = '';
                    }
                    // if (@in_array($segs[1],$page['seg1'])) { $s.=" active open"; }
                    if ($uri_string == $page['url']) {
                        $s .= " active open";
                    }
                    echo "<li class='nav-item $s'>";
                    echo "<a href='" . base_url($page['url']) . "' class='nav-link'>";
                    if (@$page['icon']) {
                        echo "<i class='icon-" . $page['icon'] . "'></i> ";
                    }
                    echo "<span class='title'>$page[text]</span>";
                    if (isset($section['seg1'])) {
                        if (is_array($section['seg1'])) {
                            if (@in_array($segs[1], $section['seg1'])) {
                                echo "<span class='selected'></span>";
                            }
                        }
                    }
                    echo "</a></li>";
                }

                echo "</ul>";
            }
            echo "</li>";
        }
        ?>

    </ul>
    <!-- END SIDEBAR MENU -->
</div>