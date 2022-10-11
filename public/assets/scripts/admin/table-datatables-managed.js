var TableDatatablesManaged = function () {

    
    var initUsersTable = function () {

        var table = $('#users_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,            
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': []
                }, 
                {
                    "searchable": false,
                    "targets": []
                },
            ],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#users_table_wrapper');

    }
    
    // LOCATIONS    
    var initLocationsTable = function () {
        var table = $('#locations_table');
        table.dataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"] 
            ],
            "pageLength": 10,  
            
        });
    }
    
    // PROPERTY TYPES    
    var initTypesTable = function () {
        var table = $('#types_table');
        table.dataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"] 
            ],
            "pageLength": 10,  
        });
    }
    
    // PROPERTIES   
    var initPropertiesTable = function () {
        var table = $('#properties_table');
        table.dataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"] 
            ],
            "pageLength": 10,  
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': [4]
                }, 
                {
                    "searchable": false,
                    "targets": [0]
                },
            ],
            "order": [
                [1, "asc"]
            ]
        });
    }
    

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
           
            initUsersTable();
            initLocationsTable();
            initTypesTable();
            initPropertiesTable();
        }

    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}