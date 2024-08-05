import { defineComponent as d, defineAsyncComponent as m, openBlock as a, createElementBlock as y, Fragment as f, createCommentVNode as g, createBlock as b, resolveDynamicComponent as C, unref as h, normalizeProps as B, guardReactiveProps as S } from "vue";
import { Chart as _, CategoryScale as A, LinearScale as E, Title as P, Tooltip as v, Legend as L, BarElement as k, ArcElement as x, PointElement as j, LineElement as q } from "chart.js";
const D = /* @__PURE__ */ d({
  __name: "MazChart",
  props: {
    /**
     * Chart.js chart type
     */
    type: {
      type: String,
      required: !0
    },
    /**
     * The data object that is passed into the Chart.js chart
     * @see https://www.chartjs.org/docs/latest/getting-started/
     */
    data: {
      type: Object,
      required: !0
    },
    /**
     * The options object that is passed into the Chart.js chart
     * @see https://www.chartjs.org/docs/latest/general/options.html
     */
    options: {
      type: Object,
      default: () => ({})
    },
    /**
     * The plugins array that is passed into the Chart.js chart
     * @see https://www.chartjs.org/docs/latest/developers/plugins.html
     */
    plugins: {
      type: Array,
      default: () => []
    },
    /**
     * Key name to identificate dataset
     */
    datasetIdKey: {
      type: String,
      default: "label"
    },
    /**
     * A mode string to indicate transition configuration should be used.
     * @see https://www.chartjs.org/docs/latest/developers/api.html#update-mode
     */
    updateMode: {
      type: String,
      default: void 0
    }
  },
  setup(n) {
    const e = n;
    _.register(
      A,
      E,
      P,
      v,
      L,
      k,
      x,
      j,
      q
    );
    const o = m(async () => {
      const { Bar: t, Bubble: r, Doughnut: c, Line: u, Pie: l, PolarArea: p, Radar: i, Scatter: s } = await import("vue-chartjs");
      switch (e.type) {
        case "bar":
          return t;
        case "line":
          return u;
        case "scatter":
          return s;
        case "bubble":
          return r;
        case "pie":
          return l;
        case "doughnut":
          return c;
        case "polarArea":
          return p;
        case "radar":
          return i;
      }
    });
    return (t, r) => (a(), y(
      f,
      null,
      [
        g(" @vue-expect-error "),
        (a(), b(
          C(h(o)),
          B(S(e)),
          null,
          16
          /* FULL_PROPS */
        ))
      ],
      2112
      /* STABLE_FRAGMENT, DEV_ROOT_FRAGMENT */
    ));
  }
});
export {
  D as default
};
