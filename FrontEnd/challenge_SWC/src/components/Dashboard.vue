<template>
    <b-container class="gridContainer" fluid>
        <b-row class="text-center">

            <b-col>
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title-item-class="tabFont" @click="handleActiveTab(0)" title="System Manager" active>
                            <b-card no-body>
                                <b-tabs card>
                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(2)" title="Add Planet"
                                        active>
                                        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-1" label="Planet name:" label-for="input-1">
                                                <b-form-input id="input-1" v-model="form.name"
                                                    placeholder="Enter Planet name" required></b-form-input>
                                            </b-form-group>
                                            <b-container fluid>
                                                <b-row class="text-center">
                                                    <b-col>
                                                        <b-form-group id="input-group-3" label="Size X:"
                                                            label-for="input-3">
                                                            <b-form-input id="input-3" v-model="form.sizeX"
                                                                type="number" required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-4" label="Size Y:"
                                                            label-for="input-4">
                                                            <b-form-input id="input-4" v-model="form.sizeY"
                                                                type="number" required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                            </b-container>

                                            <b-container fluid>
                                                <b-row class="text-center">
                                                    <b-col>
                                                        <b-form-group id="input-group-5" label="System X:"
                                                            label-for="input-5">
                                                            <b-form-input id="input-5" v-model="form.sysX" type="number"
                                                                required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-6" label="System Y:"
                                                            label-for="input-6">
                                                            <b-form-input id="input-6" v-model="form.sysY" type="number"
                                                                required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                            </b-container>

                                            <b-container fluid>
                                                <b-row class="text-center">
                                                    <b-col>
                                                        <b-form-group id="input-group-7" label="Galaxy X:"
                                                            label-for="input-7">
                                                            <b-form-input id="input-7" v-model="form.galX" type="number"
                                                                required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-8" label="Galaxy Y:"
                                                            label-for="input-8">
                                                            <b-form-input id="input-8" v-model="form.galY" type="number"
                                                                required></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                            </b-container>
                                            <b-form-group id="input-group-9" label="Planet image url:"
                                                label-for="input-9">
                                                <b-form-input id="input-9" v-model="form.img_url"
                                                    placeholder="Enter Planet image url" type="url"
                                                    required></b-form-input>
                                            </b-form-group>
                                            <b-container class="formContainer">
                                                <b-row class="text-center">
                                                    <b-col>
                                                        <h6>Image preview</h6>
                                                        <b-img class="previewImg" :src="form.img_url" />
                                                    </b-col>
                                                </b-row>

                                            </b-container>
                                            <b-form-group>
                                                <b-button type="submit" variant="primary">Submit</b-button>
                                                <b-button type="reset" variant="danger">Reset</b-button>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(3)" title="Edit Planet">
                                        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-1" label="Email address:" label-for="input-1"
                                                description="We'll never share your email with anyone else.">
                                                <b-form-input id="input-1" v-model="form.email" type="email"
                                                    placeholder="Enter email" required></b-form-input>
                                            </b-form-group>

                                            <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                                                <b-form-input id="input-2" v-model="form.name" placeholder="Enter name"
                                                    required></b-form-input>
                                            </b-form-group>

                                            <b-form-group id="input-group-3" label="Food:" label-for="input-3">
                                                <b-form-select id="input-3" v-model="form.food" :options="foods"
                                                    required></b-form-select>
                                            </b-form-group>

                                            <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">
                                                <b-form-checkbox-group v-model="form.checked" id="checkboxes-4"
                                                    :aria-describedby="ariaDescribedby">
                                                    <b-form-checkbox value="me">Check me out</b-form-checkbox>
                                                    <b-form-checkbox value="that">Check that out</b-form-checkbox>
                                                </b-form-checkbox-group>
                                            </b-form-group>

                                            <b-button type="submit" variant="primary">Submit</b-button>
                                            <b-button type="reset" variant="danger">Reset</b-button>
                                        </b-form>
                                        <b-card class="mt-3" header="Form Data Result">
                                            <pre class="m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(4)" title="Delete Planet">
                                        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-1" label="Email address:" label-for="input-1"
                                                description="We'll never share your email with anyone else.">
                                                <b-form-input id="input-1" v-model="form.email" type="email"
                                                    placeholder="Enter email" required></b-form-input>
                                            </b-form-group>

                                            <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                                                <b-form-input id="input-2" v-model="form.name" placeholder="Enter name"
                                                    required></b-form-input>
                                            </b-form-group>

                                            <b-form-group id="input-group-3" label="Food:" label-for="input-3">
                                                <b-form-select id="input-3" v-model="form.food" :options="foods"
                                                    required></b-form-select>
                                            </b-form-group>

                                            <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">
                                                <b-form-checkbox-group v-model="form.checked" id="checkboxes-4"
                                                    :aria-describedby="ariaDescribedby">
                                                    <b-form-checkbox value="me">Check me out</b-form-checkbox>
                                                    <b-form-checkbox value="that">Check that out</b-form-checkbox>
                                                </b-form-checkbox-group>
                                            </b-form-group>

                                            <b-button type="submit" variant="primary">Submit</b-button>
                                            <b-button type="reset" variant="danger">Reset</b-button>
                                        </b-form>
                                        <b-card class="mt-3" header="Form Data Result">
                                            <pre class="m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>
                                </b-tabs>
                            </b-card>



                        </b-tab>
                        <b-tab title-item-class="tabFont" @click="handleActiveTab(1)" title="Deposit Manager">
                            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                <b-form-group id="input-group-1" label="Email address:" label-for="input-1"
                                    description="We'll never share your email with anyone else.">
                                    <b-form-input id="input-1" v-model="form.email" type="email"
                                        placeholder="Enter email" required></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                                    <b-form-input id="input-2" v-model="form.name" placeholder="Enter name"
                                        required></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-3" label="Food:" label-for="input-3">
                                    <b-form-select id="input-3" v-model="form.food" :options="foods"
                                        required></b-form-select>
                                </b-form-group>

                                <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">
                                    <b-form-checkbox-group v-model="form.checked" id="checkboxes-4"
                                        :aria-describedby="ariaDescribedby">
                                        <b-form-checkbox value="me">Check me out</b-form-checkbox>
                                        <b-form-checkbox value="that">Check that out</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group>

                                <b-button type="submit" variant="primary">Submit</b-button>
                                <b-button type="reset" variant="danger">Reset</b-button>
                            </b-form>
                            <b-card class="mt-3" header="Form Data Result">
                                <pre class="m-0">{{ form }}</pre>
                            </b-card>
                        </b-tab>
                    </b-tabs>
                </b-card>

            </b-col>




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



            <b-col>

                <b-card class="" title="Deposit information" header-tag="header">
                    <template #header>
                        <h6 class="mb-0">Selected planet: Ord Radama</h6>
                    </template>
                    <b-table striped hover :items="items"></b-table>
                </b-card>

            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    name: "Planets",
    data() {
        return {
            items: [
                { id: 1, deposit_name: 'Quantum', terrain_xy: "[1,5]", quantity: 400000 },
                { id: 2, deposit_name: 'Meleenium', terrain_xy: "[2,4]", quantity: 400000 },
                { id: 3, deposit_name: 'Ardanium', terrain_xy: "[3,3]", quantity: 400000 },
                { id: 4, deposit_name: 'Rudic', terrain_xy: "[4,2]", quantity: 400000 },
                { id: 5, deposit_name: 'Ryll', terrain_xy: "[5,1]", quantity: 400000 },

            ],
            menuTab: 0,
            planetArray: [{}],
            form: {
                name: '',
                sizeX: 0,
                sizeY: 0,
                sysX: 0,
                sysY: 0,
                galX: 0,
                galY: 0,
                img_url: ''
            },
            foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
            show: true
        };
    },
    mounted() {
        this.getPlanetsAxios().then(response => this.planetArray = response)
    },
    methods: {
        handleActiveTab(tab) {
            self.menuTab = tab
            console.log(self.menuTab)
        },
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
        },
        onSubmit(event) {
            event.preventDefault()
            alert(JSON.stringify(this.form))
        },
        onReset(event) {
            event.preventDefault()
            // Reset our form values
            this.form.email = ''
            this.form.name = ''
            this.form.food = null
            this.form.checked = []
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    }
};
</script>
<style>
.cardWidth {
    width: 100%;
    box-sizing: border-box;
    max-height: 100%;
    max-width: 200px;
}

.previewImg {
    max-width: 400px;
}

.tableTitle {
    margin-bottom: 5% !important;
}

.tabFont {
    font-size: 100%;
    max-width: 50%;
}

.border-light2 {
    border-width: 1px !important;
}

.planetImg {
    height: 100% !important;
    vertical-align: top !important;
}

.planetFrame {
    height: 20px !important;
    width: 20px !important;
    max-width: 20px !important;
    max-height: 20px !important;
}

.formContainer {
    margin-bottom: 5% !important;
}

.gridContainer {
    min-width: 900px;
    margin-top: 2% !important;
}

.planet {
    background-color: rgb(0, 0, 0);
}

.spaceBorder {
    border-style: solid;
    border-width: 1px;
}

.spaceGridX {
    height: 20px !important;
    width: 20px !important;
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
    width: 400px !important;
    height: 400px !important;
    min-width: 400px !important;
    min-height: 400px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    background-image: url('https://images.swcombine.com//galaxy/systems/starfield.gif');
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
</style>