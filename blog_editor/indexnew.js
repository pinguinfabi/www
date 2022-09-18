var id = "";
var url = window.location.href;
var editor;
if (url.indexOf("id=") > -1) {

    // Split out the id
    id = url.split('id=')[1];
    id = id.split('&')[0];
}

$.getJSON('../blog/blog_entry_json_' + id + '.json', (filedata) => {
    console.log(filedata);
    const edjsParser = edjsHTML();
    if (filedata.length) {
        console.log("Previous data found, loading...");
        options = {
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
            },
            data: filedata
        }
    } else {
        console.log("No previous data found");
        options = {
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
            }
        }
    }

    editor = new EditorJS(options);


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