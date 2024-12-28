import {
    Chart,
    DoughnutController,
    ArcElement,
    Tooltip,
    Legend,
} from "chart.js";

// Register the required components
Chart.register(DoughnutController, ArcElement, Tooltip, Legend);

document.addEventListener("DOMContentLoaded", () => {
    const { checked, missed, remaining } = window.investmentData;

    const investmentData = {
        labels: [
            checked + " Days Checked",
            missed + " Days Missed",
            remaining + " Days Remaining",
        ],
        datasets: [
            {
                label: "Investment Progress",
                data: [checked, missed, remaining],
                backgroundColor: ["#4CAF50", "#F44336", "#FFC107"],
                hoverOffset: 4,
            },
        ],
    };

    const investmentOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: "bottom",
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        const label = context.label || "";
                        const value = context.raw || 0;
                        return `${label}: ${value} days`;
                    },
                },
            },
        },
    };

    const ctx = document
        .getElementById("investmentProgressChart")
        .getContext("2d");
    new Chart(ctx, {
        type: "doughnut",
        data: investmentData,
        options: investmentOptions,
    });
});
