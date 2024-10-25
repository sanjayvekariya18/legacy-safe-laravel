export class Select {
    init() {
        this.SelectOne();
        this.SelectTwo();
        this.CreateAccountSelect();
        this.UserSelect();
    }
    SelectOne() {
        $(".js-select1").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "manager-select2"
        });
    }
    SelectTwo() {
        $(".js-select2").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "manager-check-select2"
        });
    }
    CreateAccountSelect() {
        $(".js-select3").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "manager-select2"
        });
    }
    UserSelect() {
        $(".js-select4").select2({
            closeOnSelect: true,
            placeholder: "Select a state",
            allowClear: false,
            minimumResultsForSearch: Infinity,
            dropdownCssClass: "user-select2",
            dropdownParent: $('#invite-user')
        });
    }
}
