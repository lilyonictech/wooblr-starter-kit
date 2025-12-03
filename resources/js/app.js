import "./bootstrap";

import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

Alpine.magic("currency", () => {
    return (number, decimal = 2, type = "IDR", prefix = true) => {
        const locales = {
            USD: "en-US",
            EUR: "de-DE",
            JPY: "ja-JP",
            IDR: "id-ID",
        };

        const currencySymbols = {
            USD: "$",
            EUR: "€",
            JPY: "¥",
            IDR: "Rp",
        };

        let locale = locales[type] || "id-ID";
        let symbol = currencySymbols[type] || "Rp";

        number = Math.floor((number ?? 0) * 100) / 100;

        const formattedNumber = new Intl.NumberFormat(locale, {
            minimumFractionDigits: 0,
            maximumFractionDigits: decimal,
        }).format(number);

        return prefix ? symbol + formattedNumber : formattedNumber;
    };
});

Alpine.magic("clipboard", () => {
    return (subject) => navigator.clipboard.writeText(subject);
});

document.addEventListener("alpine:init", () => {
    Alpine.store("wooblr_sidebar", {
        isScroll: Alpine.$persist([]).as("scrollSidebar"),
        scrollGroup: function (scroll) {
            this.isScroll = scroll;
        },
    });
});
Livewire.start();
