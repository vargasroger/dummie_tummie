<template>
    <div>
        <vue-good-table
                :columns="columns"
                :rows="tableData"
                :sort-options="{
                    enabled: true,
                    initialSortBy: {field: 'full_name', type: 'asc'}
                }"
                :isLoading=loading
                :pagination-options="{
                    enabled: true,
                    position: 'bottom',
                    perPageDropdown: [10, 25, 50, 100],
                    dropdownAllowAll: false,
                    setCurrentPage: 2,
                    nextLabel: translate.pagination.next,
                    prevLabel: translate.pagination.prev,
                    rowsPerPageLabel: translate.pagination.rows_pages,
                    ofLabel: translate.pagination.of,
                    pageLabel: 'page', // for 'pages' mode
                    allLabel: 'All',
                }"
        >
            <div slot="emptystate">
                {{ translate.no_results }}
            </div>
        </vue-good-table>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        props: {
            fetchUrl: {type: String, required: true},
            // columns: {type: Array, required: true},
        },
        data() {
            return {
                translate: {
                    no_results: '',
                    pagination: {
                        next: '',
                        prev: '',
                        of: '',
                        rows_pages: '',
                    }
                },
                loading: true,
                tableData: [],
                columns: [],
            }
        },
        created() {
            axios.get('/users/translate-table')
                .then(response => {
                    this.translate.no_results = response.data.no_results;
                    this.translate.pagination.next = response.data.pagination.next;
                    this.translate.pagination.prev = response.data.pagination.prev;
                    this.translate.pagination.of = response.data.pagination.of;
                    this.translate.pagination.rows_pages = response.data.pagination.rows_pages;
                });

            return this.fetchData(this.fetchUrl)
        },
        computed: {
            teste() {
                return this.translate.name;
            },
        },
        methods: {
            fetchData(url) {
                axios.get(url)
                    .then(data => {
                        this.loading = false;
                        this.tableData = data.data.data
                        this.columns = data.data.columns
                    })
            },
            /**
             * Get the serial number.
             * @param key
             * */
            serialNumber(key) {
                return key + 1;
            },
        },
        filters: {
            columnHead(value) {
                return value.split('_').join(' ').toUpperCase()
            }
        },
        name: 'DataTable'
    }
</script>

<style scoped>
</style>