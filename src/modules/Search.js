import $ from 'jquery';

class Search {

  constructor() {
   this.openButton = $('.js-search-trigger');
   this.closeButton = $('.search-overlay__close');
   this.searchOverlay = $('.search-overlay');
   this.searchField = $('#search-term');
   this.events();
   this.isOverlayOpen = false;
   this.typingTimer;
  }

  events(){
  	this.openButton.on('click', this.openOverlay.bind(this));
  	this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on('keyup', this.KeyPressDispatcher.bind(this));
    this.searchField.on('keydown', this.typingLogic.bind(this));
  }

  typingLogic(){
    clearTimeout(this.typingTimer);
    this.typingTimer = setTimeout(function(){console.log('This is test timeout');}, 2000);
  }

  KeyPressDispatcher(e){
    //console.log(e.keyCode);

    if (e.keyCode == 38 && !this.isOverlayOpen) {this.openOverlay()}
    if (e.keyCode == 27 && this.isOverlayOpen) {this.closeOverlay()}
  }
  openOverlay(){
  	this.searchOverlay.addClass('search-overlay--active');
    $('body').addClass('body-no-scroll');
    console.log('Our openOverlay method just run!');
    this.isOverlayOpen = true;
  }

  closeOverlay(){
  	this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');
    console.log('Our closeOverlay method just run!');
    this.isOverlayOpen = false;
  }

}

export default Search;
