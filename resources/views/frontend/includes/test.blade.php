<!-- ***copy start here *** -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/js-beautify/js/lib/beautify-html.js"></script>
<!-- need to add this style -->
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .editor {
        width: 80%;
        margin: 20px auto;
    }

    .editor p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    ul,
    ol {
        margin: 0;
        padding: 0;
    }

    .toolbar {
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }

    .toolbar-item {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .editable {
        border: 1px solid #ccc;
        min-height: 200px;
        padding: 10px;
    }

    .code-view {
        /* display: none; */
        width: 100%;
        min-height: 200px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .editorImage,
    .editor img {
        max-width: 100%;
        width: auto;
    }


    .codeblock {
        background: #272822;
        color: white;
        /* padding: 20px; */
        /* border-radius: 6px; */
        /* margin: 15px 10px; */
        color: #f8f8f2;
        /* background: 0 0; */
        text-shadow: 0 1px rgba(0, 0, 0, .3);
        font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
        font-size: 1em;
        text-align: left;
        white-space: pre;
        word-spacing: normal;
        word-break: normal;
        word-wrap: normal;
        line-height: 1.5;
        -moz-tab-size: 4;
        -o-tab-size: 4;
        tab-size: 4;
        -webkit-hyphens: none;
        -moz-hyphens: none;
        -ms-hyphens: none;
        hyphens: none;
        padding: 0 18px;
    }

    .editor ol,
    .editor ul {
        margin-left: 20px;
    }

    /* code {
            display: block;
            background: transparent;
            color: white;
            padding: 0px 10px;
            position: relative;
            z-index: 1;
            font-size: 18px;
        }

        code::after {
            position: absolute;
            background: black;
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            padding: 20px 0;
        } */

    .editable_parent {
        position: relative;
    }

    .placeholder {
        position: absolute;
        top: 12px;
        left: 12px;
    }


    span.close {
        text-align: center;
    }
</style>

<div class="editor" name="something">
    <div class="toolbar">

        <select onchange="makeSelection(this.value, true)">
            <option value="none">Headings</button>
            <option value="h1">H1</option>
            <option value="h2">H2</option>
            <option value="h3">H3</option>
            <option value="h4">H4</option>
            <option value="h5">H5</option>
            <option value="h6">H6</option>
            <option value="pre">Pre</option>
            <option value="p">Clear</option>
        </select>

        <button class="toolbar-item" onclick="execCommand('bold')"><i class="fas fa-bold"></i></button>
        <button class="toolbar-item" onclick="makeItalic('italic')"><i class="fas fa-italic"></i></button>
        <button class="toolbar-item" onclick="execCommand('underline')"><i class="fas fa-underline"></i></button>

        <button class="toolbar-item" onclick="execCommand('justifyLeft')"><i class="fas fa-align-left"></i></button>
        <button class="toolbar-item" onclick="execCommand('justifyCenter')"><i class="fas fa-align-center"></i></button>
        <button class="toolbar-item" onclick="execCommand('justifyRight')"><i class="fas fa-align-right"></i></button>
        <button class="toolbar-item" onclick="execCommand('justifyFull')"><i class="fas fa-align-justify"></i></button>
        <button class="toolbar-item" onclick="execCommand('insertOrderedList')"><i class="fas fa-list-ol"></i></button>
        <button class="toolbar-item" onclick="execCommand('insertUnorderedList')"><i
                class="fas fa-list-ul"></i></button>

        <button class="toolbar-item" onclick="showLinkModal()"><i class="fas fa-link"></i></button>
        <button class="toolbar-item" onclick="insertImage()"><i class="fas fa-image"></i></button>
        <button class="toolbar-item" onclick="showVideoModal()"><i class="fas fa-video"></i></button>
        <button class="toolbar-item" onclick="makeCode()"><i class="fa fa-code"></i></button>

        <button class="toolbar-item" onclick="execCommand('outdent')"><i class="fas fa-angle-double-left"></i></button>
        <button class="toolbar-item" onclick="execCommand('indent')"><i class="fas fa-angle-double-right"></i></button>

        <button class="toolbar-item" onclick="execCommand('insertHorizontalRule')"><i class="fas fa-minus"></i></button>


        <!-- <button class="toolbar-item" onclick="showVideoModal1()"><i class="fas fa-video"></i></button> -->
        <button class="toolbar-item" onclick="toggleCodeView()"><i class="fa fa-terminal"></i></button>
    </div>
    <div class="editable_parent">
        <div class="editable" contenteditable="true" oninput="writeHtmlToTextArea()"></div>
        <p class="placeholder">Write your content here...</p>
    </div>
    <textarea class="code-view" spellcheck="false" oninput="insertHtmlToEditorDiv()" style="display: none;"></textarea>
    <!-- Link Modal -->
    <div id="linkModal" class="modal">
        <div class="modal-content editor_modal_content">
            <span class="close" onclick="hideLinkModal()">&times;</span>
            <label for="link">Insert Link:</label>
            <input type="text" id="link">
            <button onclick="insertLink()">Insert</button>
        </div>
    </div>
    <!-- Video Modal -->
    <div id="videoModal" class="modal">
        <div class="modal-content editor_modal_content">
            <span class="close" onclick="hideVideoModal()">&times;</span>
            <label for="video">Insert YouTube Link:</label>
            <input type="text" id="video">
            <button onclick="insertVideo()">Insert</button>
        </div>
    </div>
</div>

<!-- plugin functions -->
<script>
    // Selection save and restore functions
    var savedSelection;

    // exec command to do thngs with dom
    function execCommand(command) {
        document.execCommand(command);
        writeHtmlToTextArea();
    }

    // with arguments
    function execCommandWithArg(command, arg) {
        document.execCommand(command, false, arg);
        writeHtmlToTextArea();
    }

    function makeSelection(value, arg = false) {
        if (arg) value !== "none" ? execCommandWithArg('formatBlock', value) : ''
        else value !== "none" ? execCommand(value) : ''
    }

    function toggleCodeView() {
        document.querySelector('.code-view').style.display === "none" ?
            document.querySelector('.code-view').style.display = "block" :
            document.querySelector('.code-view').style.display = "none"
    }

    function togglePlaceholder() {
        editable = document.querySelector('.editable');
        codeView = document.querySelector('.code-view');
        placeholder = document.querySelector('.placeholder');

        if (editable.childNodes.length === 0 && editable.innerHTML.trim() === '') placeholder.style.display = 'block'
        else placeholder.style.display = 'none'
    }


    function writeHtmlToTextArea() {
        // toggle placeholder as needed
        togglePlaceholder()


        const codeView = document.querySelector('.code-view');
        const editable = document.querySelector('.editable');
        codeView.value = html_beautify(editable.innerHTML);
    }

    writeHtmlToTextArea()

    // update div with textarea changes
    function insertHtmlToEditorDiv() {
        const codeView = document.querySelector('.code-view');
        const editable = document.querySelector('.editable');
        editable.innerHTML = codeView.value;
    }


    function makeItalic() {
        // Check if the browser supports the command
        if (document.queryCommandSupported('italic')) {
            // Execute the italic command
            document.execCommand('italic', false, null);
        } else {
            // Fallback for browsers that don't support execCommand
            console.error('Italic command is not supported in this browser.');
        }
    }

    // insert image
    function insertImage() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(readerEvent) {
                    const img = new Image();

                    // insert this image editor
                    src = readerEvent.target.result;
                    document.execCommand('insertImage', false, src);

                    // write updates
                    writeHtmlToTextArea();
                };
                reader.readAsDataURL(file);
            }
        };
        input.click();
    }

    // Link Modal Functions
    function showLinkModal() {
        saveSelection();
        const modal = document.getElementById('linkModal');
        modal.style.display = 'block';
    }

    function hideLinkModal() {
        const modal = document.getElementById('linkModal');
        modal.style.display = 'none';
        restoreSelection();
    }

    // insert link to dom
    function insertLink() {
        restoreSelection();
        const linkInput = document.getElementById('link').value;
        if (linkInput.trim() !== '') {
            document.execCommand('createLink', false, linkInput);
            hideLinkModal();
        }
    }

    // Video Modal Functions
    function showVideoModal() {
        saveSelection()

        const modal = document.getElementById('videoModal');
        modal.style.display = 'block';
    }

    function hideVideoModal() {
        const modal = document.getElementById('videoModal');
        modal.style.display = 'none';
    }

    function insertVideo() {
        restoreSelection()
        // return;
        const embedCode = document.getElementById('video').value;
        if (embedCode.trim() !== '') {
            document.execCommand('insertHTML', false, embedCode);
            hideVideoModal();
        }
    }

    function makeCode() {
        var selection = window.getSelection();
        var range = selection.getRangeAt(0);
        var selectedText = range.toString();

        if (selectedText.trim() !== "") {
            var newElement = document.createElement("div");
            newElement.className = "codeblock";
            newElement.textContent = selectedText;

            range.deleteContents();
            range.insertNode(newElement);
        }

        writeHtmlToTextArea()
    }


    // save selection from current point
    function saveSelection() {
        if (window.getSelection) {

            // if there is no selection then create and save that
            // createSelectionAtBeginning();    

            const sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                savedSelection = sel.getRangeAt(0).cloneRange();
            }
        } else if (document.selection && document.selection.createRange) {
            savedSelection = document.selection.createRange();
        }
    }

    // restore selection to previous point
    function restoreSelection() {
        if (savedSelection) {
            if (window.getSelection) {
                const sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(savedSelection);
            } else if (document.selection && savedSelection.select) {
                savedSelection.select();
            }
        }
    }

    // create a selection at first point of an element
    function createSelectionAtBeginning() {
        const element = document.querySelector('.editable');
        const range = document.createRange();
        const selection = window.getSelection();

        // Set the range to the beginning of the element's first child node
        range.setStart(element, 0);
        range.setEnd(element, 0);

        // Remove any existing selections
        selection.removeAllRanges();

        // Add the new range to the selection
        selection.addRange(range);

        savedSelection = range;
    }
</script>


<!-- load htmls with js -->
<script>
    // loadEditorHtmls()

    function loadEditorHtmls() {
        // Get the editor div
        var editorDiv = document.querySelector('.editor');

        // Get the name attribute of the editor div
        var editorName = editorDiv.getAttribute('name');


        // Create the toolbar HTML
        var allComponents = `
                <div class="toolbar">

                    <select onchange="makeSelection(this.value, true)">
                        <option value="none">Headings</button>
                        <option value="h1">H1</option>
                        <option value="h2">H2</option>
                        <option value="h3">H3</option>
                        <option value="h4">H4</option>
                        <option value="h5">H5</option>
                        <option value="h6">H6</option>
                        <option value="pre">Pre</option>
                        <option value="p">Clear</option>
                    </select>

                    <button class="toolbar-item" onclick="execCommand('justifyLeft')"><i class="fas fa-align-left"></i></button>
                    <button class="toolbar-item" onclick="execCommand('justifyCenter')"><i
                            class="fas fa-align-center"></i></button>
                    <button class="toolbar-item" onclick="execCommand('justifyRight')"><i
                            class="fas fa-align-right"></i></button>
                    <button class="toolbar-item" onclick="execCommand('justifyFull')"><i
                            class="fas fa-align-justify"></i></button>
                    <button class="toolbar-item" onclick="execCommand('insertOrderedList')"><i
                            class="fas fa-list-ol"></i></button>
                    <button class="toolbar-item" onclick="execCommand('insertUnorderedList')"><i
                            class="fas fa-list-ul"></i></button>

                    <button class="toolbar-item" onclick="execCommand('bold')"><i class="fas fa-bold"></i></button>
                    <button class="toolbar-item" onclick="makeItalic('italic')"><i class="fas fa-italic"></i></button>
                    <button class="toolbar-item" onclick="execCommand('underline')"><i class="fas fa-underline"></i></button>

                    <button class="toolbar-item" onclick="execCommand('insertHorizontalRule')"><i
                            class="fas fa-minus"></i></button>
                    <button class="toolbar-item" onclick="execCommand('outdent')"><i
                            class="fas fa-angle-double-left"></i></button>
                    <button class="toolbar-item" onclick="execCommand('indent')"><i
                            class="fas fa-angle-double-right"></i></button>
                    <button class="toolbar-item" onclick="makeCode()"><i class="fa fa-code"></i></button>


                    <button class="toolbar-item" onclick="insertImage()"><i class="fas fa-image"></i></button>
                    <button class="toolbar-item" onclick="showLinkModal()"><i class="fas fa-link"></i></button>
                    <!-- <button class="toolbar-item" onclick="showVideoModal1()"><i class="fas fa-video"></i></button> -->
                    <button class="toolbar-item" onclick="showVideoModal()"><i class="fas fa-video"></i></button>
                    <button class="toolbar-item" onclick="toggleCodeView()"><i class="fa fa-terminal"></i></button>
                </div>
                <div class="editable" contenteditable="true" oninput="writeHtmlToTextArea()">
                </div>
                <textarea class="code-view" spellcheck="false" oninput="insertHtmlToEditorDiv()"
                    style="display: none;"></textarea>
                <!-- Link Modal -->
                <div id="linkModal" class="modal">
                    <div class="modal-content editor_modal_content">
                        <span class="close" onclick="hideLinkModal()">&times;</span>
                        <label for="link">Insert Link:</label>
                        <input type="text" id="link">
                        <button onclick="insertLink()">Insert</button>
                    </div>
                </div>
                <!-- Video Modal -->
                <div id="videoModal" class="modal">
                    <div class="modal-content editor_modal_content">
                        <span class="close" onclick="hideVideoModal()">&times;</span>
                        <label for="video">Insert YouTube Link:</label>
                        <input type="text" id="video">
                        <button onclick="insertVideo()">Insert</button>
                    </div>
                </div>
            `;

        editorDiv.innerHTML = allComponents;
    }
</script>

<!-- ***copy end here *** -->
