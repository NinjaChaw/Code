<script type="text/babel">
    export default {
        props: ['input'],
        data: function() {
            return {
                fields: {...this.input}
            }
        },
        methods: {
            removePayout() {
                // remove last elements
                this.fields.payouts.amounts.splice(this.fields.payouts.amounts.length-1, 1);
                this.fields.payouts.types.splice(this.fields.payouts.types.length-1, 1);
            },
            addPayout() {
                this.fields.payouts.amounts.push(0);
                this.fields.payouts.types.push('percentage');
            }
        },
        updated: function () {
            this.$nextTick(() => {
                $('.ui.dropdown').not('selection').dropdown();
            });
        }
    }
</script>