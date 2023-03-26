import NotesAPI from "./NotesAPI.js";
import NotesView from "./NotesView.js";

export default class App {
    constructor(root) {
        this.notes = [];
        this.activeNote = null;
        this.view = new NotesView(root, this._handlers());

        this._refreshNotes();
    }

    _refreshNotes() {
        const notes = NotesAPI.getAllNotes();

        this._setNotes(notes);

        if (notes.length > 0) {
            this._setActiveNote(notes[0]);
        }
    }

    _setNotes(notes) {
        this.notes = notes;
        this.view.updateNoteListHTML(notes);
        this.view.updateNotesPreviewVisibility(notes.length > 0);
    }

    _setActiveNote(note) {
        this.activeNote = note;
        this.view.updateActiveNote(note);
    }

    _handlers() {
        return {
            onNoteSelect: noteId => {
                const selectedNote = this.notes.find(note => note.id == noteId);
                this.view.updateActiveNote(selectedNote);
            },
            onNoteAdd: () => {
                const newNote = {
                    title: "Note title",
                    body: "Type notes here..."
                };

                NotesAPI.saveNote(newNote);
                this._refreshNotes();
            },
            onNotesEdit: (title, body) => {
                NotesAPI.saveNote({
                    id: this.activeNote.id,
                    title: title,
                    body: body
                });

                this._refreshNotes();
            },
            onNoteDelete: noteId => {
                NotesAPI.deleteNote(noteId);
                this._refreshNotes();
            }
        }
    }
}