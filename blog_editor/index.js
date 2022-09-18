const edjsParser = edjsHTML();

const editor = new EditorJS({
    // Div containing editor
    holder: 'editorjs',
    // Other configuration properties
    tools: {
        header: {
            class: Header,
            inlineToolbar: ['link']
        },
        list: {
            class: List,
            inlineToolbar: [
                'link',
                'bold'
            ]

        },
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
        },

    }
    /**
     * onReady callback
     */
    // onReady: () => {
    //     console.log('Editor.js is ready to work!')
    // }
})


let saveBtn = document.getElementById('button_save');

saveBtn.addEventListener('click', function() {
    editor.save().then((outputData) => {
        let html = edjsParser.parse(outputData);
        var titlevalue = document.getElementById('title').value;
        let id = document.getElementById("hidden_id").innerText;
        $.ajax({
            url: "./save.php",
            type: "POST",
            data: {
                html: JSON.stringify(html),
                json: JSON.stringify(outputData),
                title: titlevalue,
                id: id
            },
            success: function(data) {
                console.log(data);
            },
            error: (error) => {
                console.error(error);
            }
        });

    });
});