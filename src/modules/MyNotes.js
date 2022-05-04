import $ from 'jquery';
class MyNotes{
	constructor(){
	this.events();
	}
	events(){
		$('.delete-note').on('click', this.deleteNote);
	}
	deleteNote(){
		$.ajax({
			beforeSend: (xhr) =>{
				xhr.setRequestHeader('X-WP-Nonce', funiversityData.nonce);
			},
			url: funiversityData.root_url + '/wp-json/wp/v2/note/148',
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