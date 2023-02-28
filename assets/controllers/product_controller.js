import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['name', 'price', 'quantity'];

    // connect() {
    //     this.count = 0;
    //
    //     this.element.addEventListener('click', () => {
    //         this.count++;
    //         this.countTarget.textContent = this.count;
    //     });
    // }

    postData(url = "", data = {}) {
        // Default options are marked with *
        const response = fetch(url, {
            method: "POST", // *GET, POST, PUT, DELETE, etc.
            mode: "cors", // no-cors, *cors, same-origin
            cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
            credentials: "same-origin", // include, *same-origin, omit
            headers: {
                "Content-Type": "application/json",
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: "follow", // manual, *follow, error
            referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        }).then((response) => {
            alert(response.json());
        }).catch((error) => {
            alert(error.toString());
        });
    }

    submit() {
        const data = {
            name: this.nameTarget.value,
            price: this.priceTarget.value,
            quantity: this.quantityTarget.value
        }

       this.postData('/product/create', data);
    }
}