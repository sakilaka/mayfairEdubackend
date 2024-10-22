<link rel="stylesheet" href="{{ asset('backend/lib/ckeditor5/ckeditor5.css') }}">

<style>
    .ck.ck-balloon-panel.ck-powered-by-balloon {
        display: none !important;
    }
</style>
<!-- ckeditor5 config - (start) -->
<script type="importmap">
{
    "imports": {
        "ckeditor5": "{{ asset('backend/lib/ckeditor5/ckeditor5.js') }}",
        "ckeditor5/": "{{ asset('backend/lib/ckeditor5/') }}"
    }
}
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Heading,
        Paragraph,
        Clipboard,
        Bold,
        Italic,
        Link,
        Alignment,
        Font,
        Indent,
        IndentBlock,
        BlockQuote,
        List,
        ImageUpload,
        Image,
        ImageInsert,
        ImageToolbar,
        LinkImage,
        ImageCaption,
        ImageResize,
        ImageStyle,
        AutoImage,
        Base64UploadAdapter /* SimpleUploadAdapter */ ,
        CodeBlock,
        Autoformat,
        FindAndReplace,
        Highlight,
        HorizontalLine,
        TodoList,
        MediaEmbed,
        RemoveFormat,
        ShowBlocks,
        SourceEditing,
        SpecialCharacters,
        SpecialCharactersEssentials,
        Table,
        TableToolbar,
        TableCellProperties,
        TableProperties,
        TableColumnResize,
        TableCaption,
        WordCount
    } from 'ckeditor5';

    window.editorInstances = {};

    document.querySelectorAll('.editor').forEach((editorElement) => {
        ClassicEditor
            .create(editorElement, {
                plugins: [
                    Essentials, Heading, Paragraph, Clipboard, Bold,
                    Italic, Link, Alignment, Font, Indent, IndentBlock,
                    BlockQuote, List,
                    ImageUpload, Image, ImageInsert, ImageToolbar,
                    LinkImage, ImageCaption, ImageResize, ImageStyle, AutoImage,
                    Base64UploadAdapter /* SimpleUploadAdapter */ ,
                    CodeBlock, Autoformat, FindAndReplace, Highlight, HorizontalLine,
                    TodoList, MediaEmbed, RemoveFormat, ShowBlocks, SourceEditing,
                    SpecialCharacters, SpecialCharactersEssentials,
                    Table, TableToolbar, TableCellProperties, TableProperties,
                    TableColumnResize, TableCaption, WordCount
                ],
                toolbar: {
                    items: [
                        'undo', 'redo', 'findAndReplace', '|',
                        'heading', '|',
                        'bold', 'italic', 'link', 'removeFormat', '|',
                        'alignment', '|',
                        'outdent', 'indent', 'blockquote', '|',
                        'insertImage', 'mediaEmbed', '|',
                        'fontSize', 'fontFamily', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'insertTable', '|',
                        'specialCharacters', 'highlight', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'codeBlock', 'horizontalLine', '|',
                        'showBlocks', 'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: false
                },
                findAndReplace: {
                    uiType: 'dropdown'
                },
                mediaEmbed: {
                    previewsInData: true
                },
                image: {
                    resizeOptions: [{
                            name: 'resizeImage:original',
                            value: null,
                            label: 'Original'
                        },
                        {
                            name: 'resizeImage:custom',
                            label: 'Custom',
                            value: 'custom'
                        },
                        {
                            name: 'resizeImage:100',
                            value: '100',
                            label: '100%'
                        },
                        {
                            name: 'resizeImage:75',
                            value: '75',
                            label: '75%'
                        },
                        {
                            name: 'resizeImage:50',
                            value: '50',
                            label: '50%'
                        },
                        {
                            name: 'resizeImage:25',
                            value: '25',
                            label: '25%'
                        }
                    ],
                    toolbar: [
                        'resizeImage',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:side',
                        '|',
                        'imageStyle:alignLeft',
                        'imageStyle:block',
                        'imageStyle:alignRight',
                        '|',
                        'toggleImageCaption',
                        'imageTextAlternative',
                        '|',
                        'linkImage'
                    ],
                    styles: [
                        'inline',
                        'block',
                        'side',
                        'alignLeft',
                        'alignRight'
                    ],
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Normal',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        },
                    ]
                },
                fontColor: {
                    colorPicker: {
                        format: 'hex'
                    }
                },
                table: {
                    contentToolbar: [
                        'toggleTableCaption', 'tableColumn', 'tableRow', 'mergeTableCells',
                        'tableProperties', 'tableCellProperties'
                    ],
                    // defaultHeadings: { rows: 1, columns: 1 }
                },
                wordCount: {
                    onUpdate: stats => {
                        $('#word-count').text(stats.words)
                        $('#char-count').text(stats.characters)
                    }
                }
                /* simpleUpload: {
                    uploadUrl: '',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                } */
            })
            .then(editor => {
                const editorKey = editorElement.getAttribute('name') || editorElement.id || editorElement.classList.contains('editor');                
                window.editorInstances[editorKey] = editor;
            })
            .catch(error => {
                console.error(error);
            });
    })
</script>
<!-- ckeditor5 config - (end) -->
