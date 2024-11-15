export class Select {
    init() {
        this.SelectOne();
        this.SelectTwo();
        this.CreateAccountSelect();
        this.UserSelect();
    }
    SelectOne() {
        $("#js-select1").select2({
            closeOnSelect: false,
            placeholder: "Client Name (Please select)",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "manager-select2"
        });

        $("#js-select1").on("select2:select", function () {
            if ($(".select2-selection__choice").length > 0) {
                $(".select2-container--open .select2-search__field").val("");
                $(".select2-container--open .select2-search__field").attr("placeholder", "");
            }
        });

        $("#js-select1").on("select2:open", function () {
            if ($(".select2-selection__choice").length > 0) {
                $(".select2-container--open .select2-search__field").val("");
            } else {
                $(".select2-container--open .select2-search__field").attr("placeholder", "Start typing...");
            }
        });

        $("#js-select1").on("select2:close", function () {
            if ($(".select2-selection__choice").length === 0) {
                $(".select2-search__field").attr("placeholder", "Client Name (Please select)");
            }
        });
    }
    SelectTwo() {
        $(document).ready(function () {
            $("#js-select2").select2({
                closeOnSelect: false,
                placeholder: "Select Users (Please select)",
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "manager-check-select2"
            });

            $("#js-select2").on("select2:select", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                    $(".select2-container--open .select2-search__field").attr("placeholder", "");
                }
            });

            $("#js-select2").on("select2:open", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                } else {
                    $(".select2-container--open .select2-search__field").attr("placeholder", "Start typing...");
                }
            });

            $("#js-select2").on("select2:close", function () {
                if ($(".select2-selection__choice").length === 0) {
                    $(".select2-search__field").attr("placeholder", "Select Users (Please select)");
                }
            });
        });
    }
    CreateAccountSelect() {
        $(".js-select3").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "account-select2"
        });
    }
    UserSelect() {
        $("#js-select4").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "user-select2",
            dropdownParent: $('#invite-user')
        });
    }
}
