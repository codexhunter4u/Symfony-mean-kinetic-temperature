let mktManagement = {};

mktManagement = {
    /**
     * Init
     */
    init: function () {
        var self = this;
        self.bindUI();
    },

    /**
     * Bind ui
     */
    bindUI: function () {
        var self = this;
        $(document)
            .ready(function() {
                self.applyDataTable();
            });
    },

    /**
     * Apply dataTable
     */
    applyDataTable: function () {
        $('#kineticTempTable').DataTable({
            bSort: false,
            pageLength: 5,
            bLengthChange: false,
            bInfo: false,
            autoWidth: true,
        });
        // $('.dataTables_filter').hide();
    },
};

$(function () {
    mktManagement.init();
    // Show form errors on add form
    $('.invalid-feedback').css('display', 'block');
    // Remove the flass message
    $('.flash-messages').delay(3000).slideUp(2000);
});
