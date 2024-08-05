import { openBlock as e, createElementBlock as t, createElementVNode as o } from "vue";
const n = {
  xmlns: "http://www.w3.org/2000/svg",
  width: "1em",
  height: "1em",
  fill: "none",
  viewBox: "0 0 24 24"
}, r = /* @__PURE__ */ o(
  "path",
  {
    stroke: "currentColor",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    "stroke-width": "1.5",
    d: "M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0m-9 3.75h.008v.008H12z"
  },
  null,
  -1
  /* HOISTED */
), c = [
  r
];
function i(l, s) {
  return e(), t("svg", n, [...c]);
}
const h = { render: i };
export {
  h as default,
  i as render
};
