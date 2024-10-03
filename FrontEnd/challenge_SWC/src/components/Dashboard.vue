<template>
    <b-container class="gridContainer" fluid>
        <b-row class="text-center">

            <b-col>
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title-item-class="tabFont" @click="handleActiveTab(0)" title="System Manager" active>
                            <b-form @submit="onSubmitGalCoords" @reset="onReset" v-if="show">
                                <b-container fluid>
                                    <b-row class="text-center">
                                        <b-col>
                                            <b-form-group id="input-group-10" label="Galaxy X:" label-for="input-7">
                                                <b-form-input id="input-10" v-model="galaxyCoords.x" type="number"
                                                    required></b-form-input>
                                            </b-form-group>
                                        </b-col>
                                        <b-col>
                                            <b-form-group id="input-group-11" label="Galaxy Y:" label-for="input-8">
                                                <b-form-input id="input-11" v-model="galaxyCoords.y" type="number"
                                                    required></b-form-input>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                </b-container>
                                <b-form-group>
                                    <b-container>
                                        <b-row>
                                            <b-col align-self="center"><b-overlay :show="submitingPlanet" rounded
                                                    opacity="0.6" spinner-small spinner-variant="primary"
                                                    class="d-inline-block">

                                                    <b-button type="submit" variant="primary">Set Coords</b-button>
                                                </b-overlay>
                                            </b-col>
                                            <b-col align-self="center">
                                                <b-button type="reset" variant="danger">Reset
                                                    Coords</b-button>
                                            </b-col>
                                        </b-row>
                                    </b-container>
                                </b-form-group>
                            </b-form>

                            <b-card no-body>
                                <b-tabs card>
                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(2)" title="Add Planet"
                                        active>
                                        <b-form @submit="onSubmitCreatePlanet" @reset="onReset" v-if="show">
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
                                                <b-container>
                                                    <b-row>
                                                        <b-col align-self="center">
                                                            <b-overlay :show="submitingPlanet" rounded opacity="0.6"
                                                                spinner-small spinner-variant="primary"
                                                                class="d-inline-block">

                                                                <b-button type="submit" variant="primary">Create
                                                                    Planet</b-button>
                                                            </b-overlay>
                                                        </b-col>
                                                        <b-col align-self="center">
                                                            <b-button type="reset" variant="danger">Reset
                                                                Coords</b-button>
                                                        </b-col>
                                                    </b-row>
                                                </b-container>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(3)" title="Edit Planet">
                                        <b-form @submit="onSubmitEditPlanet" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-12" label-for="input-12">
                                                <b-form-input v-model="planetSearchName" type="search"></b-form-input>

                                                <b-form-select @input="setUpdateForm" v-model="selectedPlanet"
                                                    :select-size="searchSize">
                                                    <b-form-select-option v-if="planet.name !== undefined"
                                                        :key="planet.id" :value="planet.name"
                                                        v-for="planet in planetFilteredArray">{{ planet.name
                                                        }}</b-form-select-option>
                                                </b-form-select>

                                            </b-form-group>
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
                                                <b-container>
                                                    <b-row>
                                                        <b-col align-self="center">
                                                            <b-overlay :show="submitingPlanet" rounded opacity="0.6"
                                                                spinner-small spinner-variant="primary"
                                                                class="d-inline-block">

                                                                <b-button type="submit" variant="primary">Create
                                                                    Planet</b-button>
                                                            </b-overlay>
                                                        </b-col>
                                                        <b-col align-self="center">
                                                            <b-button type="reset" variant="danger">Reset
                                                                Coords</b-button>
                                                        </b-col>
                                                    </b-row>
                                                </b-container>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(4)" title="Delete Planet">
                                        <b-form @submit="onSubmitDeletePlanet" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-12" label-for="input-12">
                                                <b-form-input v-model="planetSearchName" type="search"></b-form-input>

                                                <b-form-select @input="setUpdateForm" v-model="selectedPlanet"
                                                    :select-size="searchSize">
                                                    <b-form-select-option v-if="planet.name !== undefined"
                                                        :key="planet.id" :value="planet.name"
                                                        v-for="planet in planetFilteredArray">{{ planet.name
                                                        }}</b-form-select-option>
                                                </b-form-select>

                                            </b-form-group>
                                            <b-form-group id="input-group-1" label="Planet name:" label-for="input-1">
                                                <b-form-input id="input-1" v-model="form.name" disabled></b-form-input>
                                            </b-form-group>
                                            <b-container fluid>
                                                <b-row class="text-center">
                                                    <b-col>
                                                        <b-form-group id="input-group-3" label="Size X:"
                                                            label-for="input-3">
                                                            <b-form-input id="input-3" v-model="form.sizeX"
                                                                type="number" disabled></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-4" label="Size Y:"
                                                            label-for="input-4">
                                                            <b-form-input id="input-4" v-model="form.sizeY"
                                                                type="number" disabled></b-form-input>
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
                                                            disabled></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-6" label="System Y:"
                                                            label-for="input-6">
                                                            <b-form-input id="input-6" v-model="form.sysY" type="number"
                                                            disabled></b-form-input>
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
                                                            disabled></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                    <b-col>
                                                        <b-form-group id="input-group-8" label="Galaxy Y:"
                                                            label-for="input-8">
                                                            <b-form-input id="input-8" v-model="form.galY" type="number"
                                                            disabled></b-form-input>
                                                        </b-form-group>
                                                    </b-col>
                                                </b-row>
                                            </b-container>
                                            <b-form-group id="input-group-9" label="Planet image url:"
                                                label-for="input-9">
                                                <b-form-input id="input-9" v-model="form.img_url"
                                                    placeholder="Enter Planet image url" type="url"
                                                    disabled></b-form-input>
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
                                                <b-container>
                                                    <b-row>
                                                        <b-col align-self="center">
                                                            <b-overlay :show="submitingPlanet" rounded opacity="0.6"
                                                                spinner-small spinner-variant="primary"
                                                                class="d-inline-block">
                                                                <b-button type="submit" variant="danger">Delete Planet</b-button>
                                                            </b-overlay>
                                                        </b-col>
                                                    </b-row>
                                                </b-container>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>
                                </b-tabs>
                            </b-card>
                        </b-tab>

                        <b-tab title-item-class="tabFont" @click="handleActiveTab(0)" title="Terrain Manager">
                            <b-form @submit="onSubmitGalCoords" @reset="onReset" v-if="show">
                                <b-container fluid>
                                    <b-row class="text-center">
                                        <b-col>
                                            <b-form-group id="input-group-10" label="Galaxy X:" label-for="input-7">
                                                <b-form-input id="input-10" v-model="form.galX" type="number"
                                                    required></b-form-input>
                                            </b-form-group>
                                        </b-col>
                                        <b-col>
                                            <b-form-group id="input-group-11" label="Galaxy Y:" label-for="input-8">
                                                <b-form-input id="input-11" v-model="form.galY" type="number"
                                                    required></b-form-input>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                </b-container>
                                <b-form-group>
                                    <b-container>
                                        <b-row>
                                            <b-col align-self="center"><b-overlay :show="submitingPlanet" rounded
                                                    opacity="0.6" spinner-small spinner-variant="primary"
                                                    class="d-inline-block">

                                                    <b-button type="submit" variant="primary">Set Coords</b-button>
                                                </b-overlay>
                                            </b-col>
                                            <b-col align-self="center">
                                                <b-button type="reset" variant="danger">Reset
                                                    Coords</b-button>
                                            </b-col>
                                        </b-row>
                                    </b-container>
                                </b-form-group>
                            </b-form>

                            <b-card no-body>
                                <b-tabs card>
                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(2)" title="Add Planet"
                                        active>
                                        <b-form @submit="onSubmitCreatePlanet" @reset="onReset" v-if="show">
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
                                                <b-container>
                                                    <b-row>
                                                        <b-col align-self="center">
                                                            <b-overlay :show="submitingPlanet" rounded opacity="0.6"
                                                                spinner-small spinner-variant="primary"
                                                                class="d-inline-block">

                                                                <b-button type="submit" variant="primary">Create
                                                                    Planet</b-button>
                                                            </b-overlay>
                                                        </b-col>
                                                        <b-col align-self="center">
                                                            <b-button type="reset" variant="danger">Reset
                                                                Coords</b-button>
                                                        </b-col>
                                                    </b-row>
                                                </b-container>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(3)" title="Edit Planet">
                                        <b-form @submit="onSubmitEditPlanet" @reset="onReset" v-if="show">
                                            <b-form-group id="input-group-12" label-for="input-12">
                                                <b-form-input v-model="planetSearchName" type="search"></b-form-input>

                                                <b-form-select @input="setUpdateForm" v-model="selectedPlanet"
                                                    :select-size="searchSize">
                                                    <b-form-select-option v-if="planet.name !== undefined"
                                                        :key="planet.id" :value="planet.name"
                                                        v-for="planet in planetFilteredArray">{{ planet.name
                                                        }}</b-form-select-option>
                                                </b-form-select>

                                            </b-form-group>
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
                                                <b-container>
                                                    <b-row>
                                                        <b-col align-self="center">
                                                            <b-overlay :show="submitingPlanet" rounded opacity="0.6"
                                                                spinner-small spinner-variant="primary"
                                                                class="d-inline-block">

                                                                <b-button type="submit" variant="primary">Create
                                                                    Planet</b-button>
                                                            </b-overlay>
                                                        </b-col>
                                                        <b-col align-self="center">
                                                            <b-button type="reset" variant="danger">Reset
                                                                Coords</b-button>
                                                        </b-col>
                                                    </b-row>
                                                </b-container>
                                            </b-form-group>

                                        </b-form>
                                        <b-card class="mt-3 justify-content" header="Form Data Result">
                                            <pre class="cardWidth m-0">{{ form }}</pre>
                                        </b-card>
                                    </b-tab>

                                    <b-tab title-item-class="tabFont" @click="handleActiveTab(4)" title="Delete Planet">
                                        <b-form @submit="onSubmitDeletePlanet" @reset="onReset" v-if="show">
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
                            <b-form @submit="onSubmitCreatePlanet" @reset="onReset" v-if="show">
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
            <b-col>
                <b-row align-h="center" class="text-center formContainer">
                    <b-card class="" title="System Map" header-tag="header">
                        <template #header>
                            <h6 class="mb-0">Selected Galaxy Coordinates: {{ '(' + galaxyCoords.x + ',' + galaxyCoords.y
                                + ')'}}</h6>
                        </template>
                        <b-col class="spaceGrid justify-content-center">
                            <b-row align-content="stretch" class="spaceGridY text-center " v-for="y in 20" :key="y">
                                <b-col class="spaceGridX spaceBorder" v-for="x in 20" :key="x">
                                    <b-img
                                        v-for="(planet, planetIndex) in planetArray.filter(planet => planet.sysX === x && planet.sysY === y)"
                                        :key="planetIndex" v-b-tooltip.auto.html="tipPlanet(x, y, planet.name)"
                                        :class="planet.name.match('Sun') ? 'planetImgSun' : 'planetImg'"
                                        :src="planet.img_url" alt="" />
                                    <div class="spaceGridX"
                                        v-if="planetArray.filter(planet => planet.sysX === x && planet.sysY === y).length === 0"
                                        v-b-tooltip.auto.html="tipCoord(x, y)">
                                    </div>
                                </b-col>
                            </b-row>
                        </b-col>
                    </b-card>


                </b-row>

                <b-row class="text-center">
                    <b-col>
                        <b-card class="" title="Deposit information" header-tag="header">
                            <template #header>
                                <h6 class="mb-0">Selected planet: Ord Radama</h6>
                            </template>
                            <b-table striped hover :items="items"></b-table>
                        </b-card>
                    </b-col>
                </b-row>
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
            submitingPlanet: false,
            menuTab: 0,
            planetSearch: {},
            planetSearchName: '',
            selectedPlanet: '',
            planetArray: [{}],
            galaxyCoords: { "x": 229, "y": 328 },
            form: {
                id: 0,
                name: undefined,
                sizeX: 0,
                sizeY: 0,
                sysX: 0,
                sysY: 0,
                galX: 0,
                galY: 0,
                img_url: undefined
            },
            foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
            show: true
        };
    },
    mounted() {
        this.getPlanetsAxios().then(response => this.planetArray = response)
    },
    computed: {
        planetFilteredArray() {
            if (this.planetSearchName !== '') {
                return this.planetArray.filter(planet => planet.name.toUpperCase().match(this.planetSearchName.toUpperCase()))
            }
            else {
                return this.planetArray
            }

        },
        searchSize() {
            if (this.planetSearchName !== '') {
                let size = this.planetFilteredArray.length
                return (size) === 1 ? size + 1 : size
            }
            else {
                return this.planetFilteredArray.length
            }
        },
        terrainCSS(url) {
            return {
                "height": "20px !important",
                "width": "20px !important",
                "padding-left": "0 !important",
                "padding-right": "0 !important",
                "padding-top": "0 !important",
                "padding-bottom": "0 !important",
                "background-image": "url('" + url + "')"
            }
        }

    },
    methods: {
        setUpdateForm() {
            if (this.planetArray.filter(planet => planet.name === this.selectedPlanet)[0] !== undefined) {
                this.form = this.planetArray.filter(planet => planet.name === this.selectedPlanet)[0]
            }


        },
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
        async getPlanetsAxios() {
            let payload = { "galX": this.galaxyCoords.x, "galY": this.galaxyCoords.y }
            const { data } = await this.axios.post(
                'http://localhost:8080/endpoints/get_planets.php', payload
            )
            return data

            // example response: { id: 1, name: "something" }
        },
        async postPlanetsAxios() {
            this.submitingPlanet = true
            let payload = this.form
            this.axios.post('http://localhost:8080/endpoints/create_planet.php', payload)
                .then((response) => {
                    console.log(payload)
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.submitingPlanet = false
                    this.getPlanetsAxios().then(response => this.planetArray = response)
                });
        },
        async editPlanetsAxios() {
            this.submitingPlanet = true
            let payload = this.form
            this.axios.put('http://localhost:8080/endpoints/update_planet.php', payload)
                .then((response) => {
                    console.log(payload)
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.submitingPlanet = false
                    this.getPlanetsAxios().then(response => this.planetArray = response)
                });
        },
        async deletePlanetsAxios() {
            this.submitingPlanet = true
            let payload = this.form
            this.axios.post('http://localhost:8080/endpoints/delete_planet.php', payload)
                .then((response) => {
                    console.log(payload)
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.submitingPlanet = false
                    this.getPlanetsAxios().then(response => this.planetArray = response)
                });
        },
        onSubmitCreatePlanet(event) {
            event.preventDefault()
            this.postPlanetsAxios()
            //alert(JSON.stringify(this.form))
        },
        onSubmitEditPlanet(event) {
            event.preventDefault()
            this.editPlanetsAxios()
            //alert(JSON.stringify(this.form))
        },
        onSubmitDeletePlanet(event) {
            event.preventDefault()
            this.deletePlanetsAxios()
            this.onReset(event)
            //alert(JSON.stringify(this.form))
        },
        onSubmitGalCoords(event) {
            event.preventDefault()
            this.getPlanetsAxios().then(response => this.planetArray = response)
            //alert(JSON.stringify(this.form))
        },
        onReset(event) {
            event.preventDefault()
            this.form.name = undefined
            this.form.sizeX = 0
            this.form.sizeY = 0
            this.form.sysX = 0
            this.form.sysY = 0
            this.form.galX = 229
            this.form.galY = 328
            this.form.img_url = undefined
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        },
    }
};
</script>
<style>
.submitingButton {
    margin-right: 100px;
}

.cardWidth {
    width: 100%;
    box-sizing: border-box;
    max-height: 100%;
    max-width: 200px;
}

.cardWidth2 {
    width: 100%;
}

.previewImg {
    max-width: 33vw;
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

.planetImgSun {
    height: 200% !important;
    width: 200% !important;
    margin-top: -50%;
    margin-left: -50%;
    vertical-align: top !important;
    z-index: 1;
    position: relative;
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
    margin-top: 5%;
    margin-bottom: 5%;
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