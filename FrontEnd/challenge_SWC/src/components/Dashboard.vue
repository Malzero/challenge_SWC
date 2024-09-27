<template>
    <b-container class="gridContainer" fluid>
        <b-row class="text-center">
            <b-col>1 of 3</b-col>
            <b-col class="spaceGrid justify-content-center" cols="8">
                <b-row align-content="stretch" class="spaceGridY text-center " v-for="y in 20" :key="y">
                    <b-col class="spaceGridX" v-for="x in 20" :key="x">
                        <div class="" v-for="(planet, planetIndex) in planetArray" :key="planetIndex" >
                            <b-img v-b-tooltip.hover :title="planet.name" class="planetImg" v-show="planet.sysX === x - 1 && planet.sysY === y - 1" fluid-grow
                                :src="planet.img" alt="" />
                        </div>
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
            notPlanet: false,
            planetArray: [
                { "name": "Ord Radama", "sysX": 8, "sysY": 12, "icon": "O", "img": "https://custom.swcombine.com/static/8/5974-large-1678833211.png" },
                { "name": "Tatooine", "sysX": 2, "sysY": 3, "icon": "T", "img": "https://custom.swcombine.com/static/8/632-large-1675095606.png" },
                { "name": "Mustafar", "sysX": 6, "sysY": 12, "icon": "M", "img": "https://images.swcombine.com//galaxy/planets/2/main.gif" },
                { "name": "Courscant", "sysX": 9, "sysY": 15, "icon": "C", "img": "https://images.swcombine.com//galaxy/planets/custom/large/3191.gif" },
                { "name": "Sun", "sysX": 15, "sysY": 7, "icon": "S", "img": "https://images.swcombine.com//galaxy/planets/9/mini.png" },
            ],
        };
    },
};
</script>

<style>


.border-light2{
    border-width: 1px !important;
}
.planetImg {
    height: 100% !important;
    width: 100% !important;
    vertical-align: top !important;
}
.planetFrame{
    height: 25px !important;
    width: 25px !important;
}

.gridContainer {
    margin-top: 5% !important;
}

.planet {
    background-color: rgb(0, 0, 0);
}

.spaceGridX {
    height: 25px !important;
    width: 25px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    border-style: solid;
    border-width: 1px;
}

.spaceGridY {
    margin-left: 0 !important;
    margin-right: 0 !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

.spaceGrid {
    width: 500px !important;
    height: 500px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    background-image: url('https://images.swcombine.com//galaxy/systems/starfield.gif');

}
</style>