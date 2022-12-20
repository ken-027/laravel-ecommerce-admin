class Validator {

    errors = [];


    static removeErrors() {
        // if (this.errors.length == 0) return;
        if (this.errors === null) return;
        document.querySelectorAll(`[validator-for]`).forEach(el => {
            el.style.display = 'none'
        });

        document.querySelectorAll(`[validator-field]`).forEach(el => {
            el.classList.remove('border-danger');
        });


    }

    static showErrors(errors) {
        if (this.errors === null || errors.length == 0) return;
        this.errors = errors;
        this.removeErrors();
        errors.forEach(error => {
            this.setErrors(error.name, error.message)
        });
    }


    static setErrors(selector, message) {
        this.validatorInput(selector);
        this.validatorMessage(selector, message)
    }

    static validatorMessage(selector, message) {
        const validatorElement = document.querySelector([`[validator-for="${selector}"]`])
        validatorElement.style.display = 'block';
        validatorElement.innerHTML = message;
    }

    static validatorInput(selector, is_true = true) {
        const input = document.querySelector(`[validator-field="${selector}"]`);
        if (is_true) return input.classList.add('border-danger')
        input.classList.remove('border-danger')

    }
}