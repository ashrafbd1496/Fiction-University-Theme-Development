import $ from 'jquery';
class MyNotes{
	constructor(){
	this.events();
	}
	events(){
		$('.delete-note').on('click', this.deleteNote);
		$('.edit-note').on('click', this.editNote);
	}
	editNote(e){
		var thisNote = $(e.target).parents('li');
		thisNote.find('.note-titile-field,.note-body-field').removeAttr('readonly').addClass('note-active-field');
		thisNote.find('.update-note').addClass('update-note--visible');
	}
	deleteNote(e){
		var thisNote = $(e.target).parents('li');
		$.ajax({
			beforeSend: (xhr) =>{
				xhr.setRequestHeader('X-WP-Nonce', funiversityData.nonce);
			},
			url: funiversityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
			type: 'DELETE',
			success: (response) =>{
				console.log('congrats');
				console.log(response);
			},
			error: (response) =>{
				console.log('Sorry');
				console.log(response);
			}
		});
	}
}

export default MyNotes;