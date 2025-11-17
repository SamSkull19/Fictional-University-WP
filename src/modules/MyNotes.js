import $ from 'jquery';

class MyNotes{
    constructor(){
        alert("Joy Bangla R");
        this.events();
    }

    events(){
        $(".delete-note").on("click", this.deleteNote);
    }

    deleteNote(){
        alert("Joy Bangla");
    }
}

export default MyNotes;