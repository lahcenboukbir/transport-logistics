function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t =
                "data-colors" +
                ("-" + document.documentElement.getAttribute("data-theme") ??
                    ""),
            t =
                document.getElementById(e).getAttribute(t) ??
                document.getElementById(e).getAttribute("data-colors");
        if (t)
            return (t = JSON.parse(t)).map(function (e) {
                var t = e.replace(" ", "");
                return -1 === t.indexOf(",")
                    ? getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(t) || t
                    : 2 == (e = e.split(",")).length
                    ? "rgba(" +
                      getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(e[0]) +
                      "," +
                      e[1] +
                      ")"
                    : t;
            });
        console.warn("data-colors attributes not found on", e);
    }
}
var options,
    chart,
    funnelChartColors = getChartColorsArray("funnel_chart"),
    pyramidChartColors =
        (funnelChartColors &&
            ((options = {
                series: [
                    {
                        name: "Funnel Series",
                        data: [1380, 1100, 990, 880, 740, 548, 330, 200],
                    },
                ],
                chart: { type: "bar", height: 350 },
                colors: funnelChartColors,
                plotOptions: {
                    bar: {
                        borderRadius: 0,
                        horizontal: !0,
                        barHeight: "80%",
                        isFunnel: !0,
                    },
                },
                dataLabels: {
                    enabled: !0,
                    formatter: function (e, t) {
                        return t.w.globals.labels[t.dataPointIndex] + ":  " + e;
                    },
                    dropShadow: { enabled: !0 },
                },
                title: { text: "Recruitment Funnel", align: "middle" },
                xaxis: {
                    categories: [
                        "Sourced",
                        "Screened",
                        "Assessed",
                        "HR Interview",
                        "Technical",
                        "Verify",
                        "Offered",
                        "Hired",
                    ],
                },
                legend: { show: !1 },
            }),
            (chart = new ApexCharts(
                document.querySelector("#funnel_chart"),
                options
            )).render()),
        getChartColorsArray("pyramid_chart"));
pyramidChartColors &&
    ((options = {
        series: [
            { name: "", data: [200, 330, 548, 740, 880, 990, 1100, 1380] },
        ],
        chart: { type: "bar", height: 350 },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: !0,
                distributed: !0,
                barHeight: "80%",
                isFunnel: !0,
            },
        },
        colors: pyramidChartColors,
        dataLabels: {
            enabled: !0,
            formatter: function (e, t) {
                return t.w.globals.labels[t.dataPointIndex];
            },
            dropShadow: { enabled: !0 },
        },
        title: { text: "Pyramid Chart", align: "middle" },
        xaxis: {
            categories: [
                "Sweets",
                "Processed Foods",
                "Healthy Fats",
                "Meat",
                "Beans & Legumes",
                "Dairy",
                "Fruits & Vegetables",
                "Grains",
            ],
        },
        legend: { show: !1 },
    }),
    (chart = new ApexCharts(
        document.querySelector("#pyramid_chart"),
        options
    )).render());
