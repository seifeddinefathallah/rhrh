import { openBlock as e, createElementBlock as o, createElementVNode as t } from "vue";
const n = {
  xmlns: "http://www.w3.org/2000/svg",
  width: "1em",
  height: "1em",
  fill: "none",
  viewBox: "0 0 24 24"
}, r = /* @__PURE__ */ t(
  "path",
  {
    stroke: "currentColor",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    "stroke-width": "1.5",
    d: "m19.5 8.25-7.5 7.5-7.5-7.5"
  },
  null,
  -1
  /* HOISTED */
), c = [
  r
];
function s(i, l) {
  return e(), o("svg", n, [...c]);
}
const h = { render: s };
export {
  h as default,
  s as render
};
