$(document).ready(function () {
        setTimeout(function () {
                $('body').addClass('loaded');
        }, 3000);

        $('#fullpage').fullpage({
                licenseKey: null,
                anchors: ["home", "profilo", "esperienze", "portfolio", "contatti"],
                recordHistory: false,
                navigation: true,
                navigationPosition: "right",

        });
});
