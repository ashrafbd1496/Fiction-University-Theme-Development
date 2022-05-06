import $ from 'jquery';
class MyNotes{
	constructor(){
	this.events();
	}
	events(){
		$('.delete-note').on('click', this.deleteNote);
		$('.edit-note').on('click', this.editNote.bind(this));
	}
	editNote(e){
		var thisNote = $(e.target).parents('li');
		if (thisNote.data('state') == 'editable') {
			this.makeNoteReadOnly(thisNote);
		}else{
			this.makeNoteEditable(thisNote);
		}
	}
	makeNoteEditable(thisNote){
		thisNote.find('.edit-note').html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
		thisNote.find('.note-titile-field,.note-body-field').removeAttr('readonly').addClass('note-active-field');
		thisNote.find('.update-note').addClass('update-note--visible');
		thisNote.data('state','editable');
		
	}
	makeNoteReadOnly(thisNote){
		thisNote.find('.edit-note').html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');
		thisNote.find('.note-titile-field,.note-body-field').attr('readonly','readonly').removeClass('note-active-field');
		thisNote.find('.update-note').removeClass('update-note--visible');
		thisNote.data('state','cancel');
		
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