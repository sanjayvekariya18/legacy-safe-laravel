export class Select {
    init() {
        this.SelectOne();
        this.SelectTwo();
        this.CreateAccountSelect();
        this.UserSelect();
        this.PlaceHolderColor();
    }
    SelectOne() {
        $(document).ready(function () {
            $("#js-select1").select2({
                closeOnSelect: true,
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
        });

    }
    SelectTwo() {
        $(document).ready(function () {
            $("#js-select2").select2({
                closeOnSelect: false,
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "manager-check-select2"
            });
                $(".select2-search").append('<span class="custom-span-placeholder">(Please select)</span>');


            $("#js-select2").on("select2:select", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                    $(".select2-container--open .select2-search__field").attr("placeholder", "");
                    $(".custom-span-placeholder").text('');
                }
            });

            $("#js-select2").on("select2:open", function () {
                if ($(".select2-selection__choice").length > 0) {
                    $(".select2-container--open .select2-search__field").val("");
                } else {
                    $(".select2-container--open .select2-search__field").attr("placeholder", "Start typing...");
                $(".custom-span-placeholder").text('');

                }
            });

            $("#js-select2").on("select2:close", function () {
                if ($(".select2-selection__choice").length === 0) {
                    $(".select2-search__field").attr("placeholder", "Select Users");
                    $(".custom-span-placeholder").text('(Please select)');

                }
            });
        });
    }
    CreateAccountSelect() {
        $(document).ready(function () {
            $("#js-select3").select2({
                closeOnSelect: true,
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "user-select2"
            });
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

        $(document).ready(function () {
            $("#js-select5").select2({
                closeOnSelect: true,
                placeholder: "Select a state",
                allowClear: false,
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "user-select2",
                dropdownParent: $("#invite-user-modal") // Ensure this is correct
            });
        });

    }
    PlaceHolderColor() {
        $('.legacy-select').each(function () {
            let placeholderText = $(this).attr('data-placeholder');
            $(this).select2({
                placeholder: placeholderText,
                allowClear: true
            });
        });

        function stylePlaceholders() {
            setTimeout(function () {
                $('.select2-selection__placeholder').each(
                    function () {
                        let text = $(this).text();
                        let modifiedText = text.replace(/\((.*?)\)/, '<span class="placeholder-color">$&</span>');
                        $(this).html(modifiedText).addClass('placeholder-custom');
                    });
            }, 1);
        }
        $('.legacy-select').on('select2:open select2:clear', function () { stylePlaceholders(); }); stylePlaceholders();
    }
}
