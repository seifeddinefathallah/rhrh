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
    d: "m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607"
  },
  null,
  -1
  /* HOISTED */
), s = [
  r
];
function i(c, l) {
  return e(), t("svg", n, [...s]);
}
const a = { render: i };
export {
  a as default,
  i as render
};
