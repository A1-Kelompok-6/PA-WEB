export const toolbarOptions = [
  ['bold', 'italic', "underline", 'strike'],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  [{ list: "ordered" }, { list: "bullet" }],
  [{ script: "sub" }, { script: "super" }],
  [{ indent: "+1" }, { indent: "-1" }],
  [{ align: [] }],
  [{ size: ["small", "large", "huge", false] }],
  ["image", "link", "video", "formula"],
  [{ color: [] }, { background: [] }],
  [{ font: [] }],
  ['code-block', "blockquote"],
];

export const quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions,
  },
  theme: "snow"
})