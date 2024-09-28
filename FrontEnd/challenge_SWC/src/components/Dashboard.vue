<template>
    <b-container class="gridContainer" fluid>
        <b-row class="text-center">
            <b-col>1 of 3</b-col>
            <b-col class="spaceGrid justify-content-center" cols="8">
                <b-row align-content="stretch" class="spaceGridY text-center " v-for="y in 20" :key="y">
                    <b-col class="spaceGridX spaceBorder" v-for="x in 20" :key="x">
                        <b-img
                            v-for="(planet, planetIndex) in planetArray.filter(planet => planet.sysX === x && planet.sysY === y)"
                            :key="planetIndex" v-b-tooltip.hover.html="tipPlanet(x, y, planet.name)" class="planetImg"
                            :src="planet.img_url" alt="" />
                        <div class="spaceGridX"
                            v-if="planetArray.filter(planet => planet.sysX === x && planet.sysY === y).length === 0"
                            v-b-tooltip.hover.html="tipCoord(x, y)"></div>
                    </b-col>
                </b-row>
            </b-col>
            <b-col>3 of 3</b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    name: "Planets",
    data() {
        return {
            planetArray: [{}]
        };
    },
    mounted() {
        this.getPlanetsAxios().then(response => this.planetArray = response)
    },
    methods: {
        tipPlanet(sysX, sysY, name) {
            // Note this is called each time the tooltip is first opened.
            let message = '(' + sysX + ', ' + sysY + ')<br/>' + name
            return message

        },
        tipCoord(sysX, sysY) {
            // Note this is called each time the tooltip is first opened.

            return '(' + sysX + ', ' + sysY + ')'
        },
        async getPlanets() {
            const { data } = await this.$http.get(
                'http://localhost:8080/endpoints/get_planets.php',
            );
            console.log(data);
            return data;
            // example response: { id: 1, name: "something" }
        },
        async getPlanetsAxios() {
            const { data } = await this.axios.get(
                'http://localhost:8080/endpoints/get_planets.php',
            )
            return data

            // example response: { id: 1, name: "something" }
        }
    }
};
</script>
<style>
.border-light2 {
    border-width: 1px !important;
}

.planetImg {
    height: 100% !important;
    vertical-align: top !important;
}

.planetFrame {
    height: 25px !important;
    width: 25px !important;
    max-width: 25px !important;
    max-height: 25px !important;
}

.gridContainer {
    min-width: 900px;
    margin-top: 5% !important;
}

.planet {
    background-color: rgb(0, 0, 0);
}

.spaceBorder{
    border-style: solid;
    border-width: 1px;
}
.spaceGridX {
    height: 25px !important;
    width: 25px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

.spaceGridY {
    margin-left: 0 !important;
    margin-right: 0 !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

.spaceGrid {
    flex: none !important;
    width: 500px !important;
    height: 500px !important;
    min-width: 500px !important;
    min-height: 500px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    background-image: url('https://images.swcombine.com//galaxy/systems/starfield.gif');

}
</style>