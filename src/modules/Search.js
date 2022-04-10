import $ from 'jquery';

class Search {

  constructor() {
    this.resultsDiv = $('#search-overlay__results');
   this.openButton = $('.js-search-trigger');
   this.closeButton = $('.search-overlay__close');
   this.searchOverlay = $('.search-overlay');
   this.searchField = $('#search-term');
   this.events();
   this.isOverlayOpen = false;
   this.isSpinnerVisible = false;
   this.typingTimer;
   this.previousValue;
  }

  events(){
  	this.openButton.on('click', this.openOverlay.bind(this));
  	this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on('keyup', this.KeyPressDispatcher.bind(this));
    this.searchField.on('keyup', this.typingLogic.bind(this));
  }

  typingLogic(){
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {

        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class = "spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
    this.typingTimer = setTimeout(this.getResults.bind(this), 2000);

      }else{
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }

    }
  
    this.previousValue = this.searchField.val();
  }

   getResults(){
   $.getJSON('http://fictionaluniversity.local/wp-json/wp/v2/posts?search=' + this.searchField.val(),posts=>{
    this.resultsDiv.html(`

      <h2 class="search-overlay__section-title">General Information </h2>
      <ul class ="link-list min-list">
        ${posts.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li></li>`).join(``)}
      </ul>
      `);
   });
  }
  
  KeyPressDispatcher(e){
    //console.log(e.keyCode);

    if (e.keyCode == 38 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {this.openOverlay()}
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
