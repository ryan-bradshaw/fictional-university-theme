import $ from 'jquery';

class Search {
    //1. create object
    constructor(){
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term")
        this.searchResults = $("#search-overlay__results");
        this.events();
        this.isOverlayOpen = false;
        this.typingTimer;
        this.isSpinnerVisible = false;
        this.previousValue; 
        
    }
    //2. events & listeners
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    //3. methods
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.isOverlayOpen = true;
        // console.log("open method fired!")
    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;
        // console.log("close method fired!")
    }

    keyPressDispatcher(e){
        // alert(e.keyCode); //for testing
        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')){ // 's' key
            this.openOverlay();
        }
        if(e.keyCode == 27 && this.isOverlayOpen){ // 'esc' key
            this.closeOverlay();
        }
    }

    typingLogic(){
        if(this.searchField.val() != this.previousValue){
            clearTimeout(this.typingTimer);

            if(this.searchField.val()){
                if(!this.isSpinnerVisible){
                    this.searchResults.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
            }
            this.typingTimer = setTimeout(this.getResults.bind(this), 1000);
        } else {
                this.searchResults.html('');
                this.isSpinnerVisible = false;
            }
        }
        this.previousValue = this.searchField.val();
    }

    getResults(){
        this.searchResults.html("Imagine real search results");
        this.isSpinnerVisible = false; 
    }
}

export default Search