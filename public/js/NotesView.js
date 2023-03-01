export default class NotesView {
    constructor(root, { onNoteSelect, onNoteAdd, onNotesEdit, onNoteDelete } = {}) {
        this.root = root;
        this.onNoteSelect = onNoteSelect;
        this.onNoteAdd = onNoteAdd;
        this.onNotesEdit = onNotesEdit;
        this.onNoteDelete = onNoteDelete;

        this.root.innerHTML = `
            <div class="notes__sidebar">
                <div class=notes__add>
                    <button class="notes__add-btn" type="button">Add Notes</button>
                </div>
                <div class="notes__list"> </div>
            </div>
            <div class="notes__preview">
                <input type="text" class="notes__title" placeholder="New Note">
                <textarea class="notes__body">Take notes...</textarea>
            </div>
        `;

        const btnAddNote = this.root.querySelector(".notes__add-btn");
        const inputTitle = this.root.querySelector(".notes__title");
        const inputBody = this.root.querySelector(".notes__body");

        btnAddNote.addEventListener("click", () => {
            this.onNoteAdd();
        });

        [inputTitle, inputBody].forEach(inputField => {
            inputField.addEventListener("blur", () => {
                const updatedNoteTitle = inputTitle.value.trim();
                const updateNoteBody = inputBody.value.trim();

                this.onNotesEdit(updatedNoteTitle, updateNoteBody);
            });
        });
 
        this.updateNotesPreviewVisibility(false);
    }

    _createNoteListItemHTML(id, title, body, updated) {
        const MAX_BODY_LENGTH = 60;

        return `
            <div class="notes__list-item" data-note-id= ${id}>
                <div class="notes__small-title">${title}</div>
                <div class="notes__small-body">
                    ${body.substring(0, MAX_BODY_LENGTH)}
                    ${body.length > MAX_BODY_LENGTH ? "..." : ""}
                </div>
                <div class="notes__small-updated">
                    ${updated.toLocaleString(undefined, { dateStyle: "full", timeStyle: "short" })}
                </div>
            </div>
        `;
    }

    updateNoteListHTML(notes) {
        const noteListContainer = this.root.querySelector(".notes__list");

        noteListContainer.innerHTML = "";

        for (const note of notes) {
            const html = this._createNoteListItemHTML(note.id, note.title, note.body, new Date(note.updated));

            noteListContainer.insertAdjacentHTML("beforeend", html);
        }

        // Add the select/delete events for each note items
        noteListContainer.querySelectorAll(".notes__list-item").forEach(noteListItem => {
            noteListItem.addEventListener("click", () => {
                this.onNoteSelect(noteListItem.dataset.noteId);
            });

            noteListItem.addEventListener("dblclick", () => {
                const doDelete = confirm("Are you sure you wanna delete the note?");

                if(doDelete) {
                    this.onNoteDelete(noteListItem.dataset.noteId);
                } 
            });
        });
    }

    updateActiveNote(selectedNote) {
        this.root.querySelector(".notes__title").value = selectedNote.title;
        this.root.querySelector(".notes__body").value = selectedNote.body;

        this.root.querySelectorAll(".notes__list-item").forEach(noteListItem => {
            noteListItem.classList.remove("notes__list-item--selected");
        });

        this.root.querySelector(`.notes__list-item[data-note-id="${selectedNote.id}"]`).classList.add("notes__list-item--selected");
    }

    updateNotesPreviewVisibility(visible) {
        this.root.querySelector(".notes__preview").style.visibility = visible ? "visible": "hidden";
    }
} 
