var id = "";
var url = window.location.href;
if (url.indexOf("id=") > -1) {

    // Split out the id
    id = url.split('id=')[1];
    id = id.split('&')[0];
}

// Create a new instance of the HTML Parser
$.getJSON('../blog/blog_entry_json_' + id + '.json', (filedata) => {
const edjsParser = edjsHTML();

// Create a new editorjs instance
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
        embed: {
            class: Embed,
            config: {
                services: {
                    youtube: true,
                    coub: true
                }
            }
        },
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
        },
    },
    data: filedata
});

// Get the filedata

// Save button listeners
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
});