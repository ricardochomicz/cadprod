
<template>
    <div>
        <div class="spinner-border text-primary" role="status" v-show="loading">
            <span class="sr-only">Loading...</span>
        </div>
        <label for="" class="mt-2 ml-2">Filtro</label>
        <select
            name=""
            class="form-control form-control-sm col-sm-2 ml-2"
            v-model="yearFilter"
            @change="loadData"
        >
            <option :value="year" v-for="year in years" :key="year">
                {{ year }}
            </option>
        </select>
        <line-chart :labels="labels" :datasets="datasets"></line-chart>
    </div>
</template>


<script>
import LineChart from "./OptionsCharts/LineChart";
export default {
    created() {
        this.loadData();
    },
    computed: {
        years() {
            let years = [];
            const currentYear = new Date().getFullYear();
            for (let year = currentYear; year >= currentYear - 5; year--) {
                years.push(year);
            }
            return years;
        },
    },
    data() {
        return {
            yearFilter: new Date().getFullYear(),
            loading: false,
            labels: [],
            datasets: [
                {
                    label: "Relatório anual de vendas",
                    data: [],
                },
            ],
        };
    },
    methods: {
        loadData() {
            this.loading = true;
            const params = { year: this.yearFilter };
            axios
                .get("/api/reports/months", { params })
                .then((response) => {
                    this.labels = response.data.labels;
                    this.datasets[0].data = response.data.values;
                })
                .catch((error) => console.log(error))
                .finally(() => (this.loading = false));
        },
    },
    components: {
        LineChart,
    },
};
</script>