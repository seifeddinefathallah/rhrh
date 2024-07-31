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
    d: "M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0"
  },
  null,
  -1
  /* HOISTED */
), c = [
  r
];
function s(i, l) {
  return e(), t("svg", n, [...c]);
}
const h = { render: s };
export {
  h as default,
  s as render
};
