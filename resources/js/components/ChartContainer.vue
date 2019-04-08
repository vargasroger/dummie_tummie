<template>
    <div>
        <bar-chart v-if="loaded" :chartData="datacollection" :options="options"></bar-chart>
    </div>
</template>

<script>
    import BarChart from './Chart.vue'

    export default {
        components: {
            BarChart
        },
        props: {
            fetchUrl: {type: String, required: true},
            // columns: {type: Array, required: true},
        },
        data: () => ({
            loaded: false,
            datacollection: {},
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    }]
                }
            }
        }),
        async mounted () {
            this.loaded = false;

            try {
                var responseRequest = await axios.get(this.fetchUrl);
                this.datacollection = responseRequest.data;
                this.loaded = true;
            } catch (e) {
                console.error(e)
            }
        },
        methods: {},
    }
</script>