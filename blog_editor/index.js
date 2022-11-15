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
                success: (data) => {
                    if (data == "norights") location.assign("../?e=norights")
                    else console.log(data);
                },
                error: (error) => {
                    console.error(error);
                }
            });

        });
    });

    let publishBtn = document.getElementById('button_publish');
    publishBtn.addEventListener('click', function() {
        let publish = 1;
        console.log(publish);
        let id = document.getElementById("hidden_id").innerText;
        $.ajax({
            url: "./publish.php",
            type: "POST",
            data: {
                id: id,
                publish: publish
            },
            success: (data) => {
                if (data == "norights") location.assign("../?e=norights")
                else console.log(data);
            },
            error: (error) => {
                console.error(error);
            }
        });

    });

    let deleteBtn = document.getElementById('button_delete');
    deleteBtn.addEventListener('click', function() {
        let id = document.getElementById("hidden_id").innerText;
        $.ajax({
            url: "./delete.php",
            type: "POST",
            data: {
                id: id,
            },
            success: (data) => {
                if (data == "SUCCESS") location.assign("../")
                else if (data == "DEL_FAIL") location.assign("../?e=del_fail")
                else if (data == "norights") location.assign("../?e=norights")
                else console.log(data);
            },
            error: (error) => {
                console.error(error);
            }
        });

    });
});