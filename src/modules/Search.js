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
    $.getJSON(funiversityData.root_url + '/wp-json/funiversity/v1/search?term=' + this.searchField.val(), (results) =>{
      this.resultsDiv.html(`
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information </h2>
              ${results.generalInfo.length ? '<ul class ="link-list min-list">' : '<p>No general Information matches here</p>'}
              ${results.generalInfo.map(item=>`<li><a href="${item.permalink}">${item.title}</a>${item.postType == 'post' ? ` by ${item.authorName}` : ''}</li></li>`).join(``)}
              ${results.generalInfo.length ? '</ul>' : ''}
          </div>
           <div class="one-third">
            <h2 class="search-overlay__section-title">Professors </h2>
              ${results.professors.length ? '<ul class ="link-list min-list">' : `<p>No Professors matches here. <a href="/professors">View All Professors</a></p>`}
              ${results.professors.map(item=>`<li><a href="${item.permalink}">${item.title}</a></li></li>`).join(``)}
              ${results.professors.length ? '</ul>' : ''}

                <h2 class="search-overlay__section-title">Campuses </h2>
                  ${results.campuses.length ? '<ul class ="link-list min-list">' : `<p>No Campuses matches here. <a href="/campuses">View All Campuses</a></p>`}
                  ${results.campuses.map(item=>`<li><a href="${item.permalink}">${item.title}</a></li></li>`).join(``)}
                  ${results.campuses.length ? '</ul>' : ''}
          </div>

           <div class="one-third">
            <h2 class="search-overlay__section-title">Programs </h2>
              ${results.programs.length ? '<ul class ="link-list min-list">' : `<p>No Programs matches here. <a href="/programs">View All Programs</a></p>`}
              ${results.programs.map(item=>`<li><a href="${item.permalink}">${item.title}</a></li></li>`).join(``)}
              ${results.programs.length ? '</ul>' : ''}

              <h2 class="search-overlay__section-title">Events</h2>
                ${results.events.length ? '<ul class ="link-list min-list">' : `<p>No Events matches here. <a href="/events">View All Events</a></p>`}
                ${results.events.map(item=>`<li><a href="${item.permalink}">${item.title}</a></li></li>`).join(``)}
                ${results.events.length ? '</ul>' : ''}
           
          </div>
        </div>
         `);
    });
  }


/**
 getResults(){
    $.when($.getJSON(funiversityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
      $.getJSON(funiversityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val()),
      ).then((posts, pages) =>{
       var combineResults = posts[0].concat(pages[0]);
      this.resultsDiv.html(`
      <h2 class="search-overlay__section-title">General Information </h2>
        ${combineResults.length ? '<ul class ="link-list min-list">' : '<p>No general Information matches here</p>'}
        ${combineResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a>${item.type == 'post' ? ` by ${item.authorName}` : ''}</li></li>`).join(``)}
      ${combineResults.length ? '</ul>' : ''}
      `);
      this.isSpinnerVisible = false;
    }, () =>{
      this.resultsDiv.html('<p> Unexpected Error ! Please try again. </p>')
    });
  }
 */
  
  
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
