import $ from 'jquery';

class Search {

  constructor() {
    this.addSearchHtml();
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
    this.typingTimer = setTimeout(this.getResults.bind(this), 750);

      }else{
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }

    }
  
    this.previousValue = this.searchField.val();
  }

   getResults(){
    $.when($.getJSON(funiversityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
      $.getJSON(funiversityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val()),
      ).then((posts, pages) =>{
       var combineResults = posts[0].concat(pages[0]);
      this.resultsDiv.html(`
      <h2 class="search-overlay__section-title">General Information </h2>
        ${combineResults.length ? '<ul class ="link-list min-list">' : '<p>No general Information matches here</p>'}
        ${combineResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li></li>`).join(``)}
      ${combineResults.length ? '</ul>' : ''}
      `);
      this.isSpinnerVisible = false;
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
    setTimeout(() =>this.searchField.focus(),301);
    console.log('Our openOverlay method just run!');
    this.isOverlayOpen = true;
  }

  closeOverlay(){
  	this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');
    console.log('Our closeOverlay method just run!');
    this.isOverlayOpen = false;
  }

  addSearchHtml(){
    $('body').append(`
      <div class="search-overlay">
     <div class="search-overlay__top">
       <div class="container">
         <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
         <input type="text" class="search-term" placeholder="What you are looking for" id="search-term">
         <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
       </div>
     </div>
      <div class="container">
        <div id="search-overlay__results">
        
        </div>
      </div>
    </div>
      `);
  }

}

export default Search;
