var Laravel = {
    RootURL: "",
    Website: {}
};

Laravel.Website = {
    isTouch: function() {
        $body = $('body');
        return $body.hasClass("touch-screen");
    },
    
    isTablet: function() {
        $body = $('body');
        return $body.hasClass("layout-tablet");
    }
};

$(function() {
    if(Laravel.Website.isTablet() || 
       Laravel.Website.isTouch()) {
        // MOBILE
    }
});

/* USEFUL FUNCTIONS */

function isNullOrWhitespaced(str){
    return str === null || str.match(/^ *$/) !== null;
}