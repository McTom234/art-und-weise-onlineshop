function createQuantitySelect(defaultValue, values, maxValue, isLastExtends, onSelect) {
    document.addEventListener("click", closeAllQuantitySelects);

    let quantitySelect = document.createElement("div");
    quantitySelect.className = "quantity-select";


    let quantityInput;


    let defaultElement = document.createElement("div");
    defaultElement.className = "select-selected";
    defaultElement.textContent = "Menge: " + defaultValue;

    quantitySelect.append(defaultElement);

    let dropdown = document.createElement("div");
    dropdown.className = "select-items select-hide";

    for (let i = 0; i < values.length; i++) {
        let element = document.createElement("div");

        if (isLastExtends && i >= values.length - 1) {
            element.textContent = values[i] + "+";
            element.addEventListener('click', function () {
                defaultElement.classList.toggle("hide");
                quantityInput.classList.toggle("hide");

            });
            dropdown.append(element);
            continue;
        }


        if (values[i] === 0) {
            element.textContent = values[i] + " (Löschen)";
        } else {
            element.textContent = values[i];
        }

        element.addEventListener('click', function () {

            onSelect(values[i]);
            defaultElement.textContent = "Menge: " + this.textContent;

            let selectedElements = dropdown.getElementsByClassName("same-as-selected");

            for (let k = 0; k < selectedElements.length; k++) {
                selectedElements[k].removeAttribute("class");
            }

            this.className = "same-as-selected";

            closeAllQuantitySelects();
        })

        dropdown.append(element);
    }

    quantitySelect.append(dropdown);

    defaultElement.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });


    if (isLastExtends) {

        quantityInput = document.createElement("div");


        const inputStartValue = values[values.length - 1];


        let input = document.createElement("input");
        input.type = "number";
        input.min = "0";
        input.max = maxValue;
        input.value = inputStartValue;

        let button = document.createElement("button");
        button.textContent = "Aktualisieren";

        function submit() {

            if (input.value < inputStartValue) {
                onSelect(input.value)

                defaultElement.classList.toggle("hide");
                quantityInput.classList.toggle("hide");


                defaultElement.textContent = "Menge: " + input.value;

                let elements = dropdown.children;

                for (let i = 0; i < elements.length; i++) {
                    if (input.value === elements[i].textContent) {
                        elements[i].className = "same-as-selected";
                    } else {
                        elements[i].removeAttribute("class");
                    }
                }

                input.value = inputStartValue;

            } else {
                onSelect(parseInt(input.value, 10))
                button.className = "hide";
                input.blur();
            }


        }


        input.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                submit();
            }
        });

        input.addEventListener("input", function () {
            button.removeAttribute("class");

            if (input.value > maxValue) {
                input.value = maxValue;
            }

            if (input.value < 0) {
                input.value = '';
            }

        });


        if (defaultValue >= inputStartValue) {
            quantityInput.className = "quantity-input";
            defaultElement.classList.toggle("hide");
            button.className = "hide";
            input.value = defaultValue;
        } else {
            quantityInput.className = "quantity-input hide";
        }

        button.addEventListener('click', submit);


        quantityInput.append(input);
        quantityInput.append(button);
        quantitySelect.append(quantityInput);

    }


    return quantitySelect;
}

function closeAllQuantitySelects() {
    let selectItems = document.getElementsByClassName("select-items");
    let selectSelected = document.getElementsByClassName("select-selected");

    for (let i = 0; i < selectSelected.length; i++) {

        selectSelected[i].classList.remove("select-arrow-active");

    }
    for (let i = 0; i < selectItems.length; i++) {
        selectItems[i].classList.add("select-hide");
    }
}