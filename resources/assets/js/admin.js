const SimpleMDE    = require('simplemde')
const deleteButton = document.querySelector('#delete')
const deleteForm   = document.querySelector('#delete-form')

new SimpleMDE({
    element: document.querySelector('#editor')
})

deleteButton.addEventListener('click', event => {
    event.preventDefault()
    deleteForm.submit()
})
