export default class NotesAPI {
    static getAllNotes() {
        let notes = JSON.parse(localStorage.getItem('digitaldiaryapp-notes'));

        if (notes == null) {
            notes = [];
            return notes;
        }

        return notes.sort((a, b) => {
            return new Date(a.updated) > new Date(b.updated) ? -1 : 1;
        });
    }

    static saveNote(newNote) {
        const notes = NotesAPI.getAllNotes();
        const existingNote = notes.find(note => note.id === newNote.id);

        if (existingNote) {
            existingNote.title = newNote.title;
            existingNote.body = newNote.body;
            existingNote.updated = new Date().toISOString();
        } else {
            newNote.id = Math.floor(Math.random() * 1000000);
            newNote.updated = new Date().toISOString();
            notes.push(newNote);
        }

        localStorage.setItem("digitaldiaryapp-notes", JSON.stringify(notes));
    }

    static deleteNote(id) {
        const notes = NotesAPI.getAllNotes();
        const newNotes = notes.filter(note => note.id != id);

        localStorage.setItem("digitaldiaryapp-notes", JSON.stringify(newNotes));
    }
}
