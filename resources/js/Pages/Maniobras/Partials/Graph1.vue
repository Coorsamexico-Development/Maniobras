<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import * as am4plugins from "@amcharts/amcharts4/plugins/sunburst"; 

am4core.useTheme(am4themes_animated);

export default {
  props:{
      data: Object,
  },

  mounted() {
    //Variables
  console.log(this.data);
  let datos = this.data; //guardamos en una variable data para iterarlos

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// create chart
let chart = am4core.create(this.$refs.chartdiv, am4plugins.Sunburst);
chart.padding(0,0,0,0);
chart.radius = am4core.percent(98);

chart.data = [{
  name: "First",
  children: [
    { name: "A1", value: 100 },
    { name: "A2", value: 60 }
  ]
},
{
  name: "Second",
  children: [
    { name: "B1", value: 135 },
    { name: "B2", value: 98 }
  ]
},
{
  name: "Third",
  children: [
    {
      name: "C1",
      children: [
        { name: "EE1", value: 130 },
        { name: "EE2", value: 87 },
        { name: "EE3", value: 55 }
      ]
    },
    { name: "C2", value: 148 },
    {
      name: "C3", children: [
        { name: "CC1", value: 53 },
        { name: "CC2", value: 30 }
      ]
    },
    { name: "C4", value: 26 }
  ]
},
{
  name: "Fourth",
  children: [
    { name: "D1", value: 415 },
    { name: "D2", value: 148 },
    { name: "D3", value: 89 }
  ]
},
{
  name: "Fifth",
  children: [
    {
      name: "E1",
      children: [
        { name: "EE1", value: 33 },
        { name: "EE2", value: 40 },
        { name: "EE3", value: 89 }
      ]
    },
    {
      name: "E2",
      value: 148
    }
  ]
}];

for (let index = 0; index < datos.length; index++) {
            const element = datos[index];
            //console.log(element.name);
            ejey.push({ category: element.nombre, ceco:element.ceco});
            //AGRUPACION 
            if(this.filtros.grupoType)
            {
              if(auxiliarGrupo.nombre == null)
              {
                auxiliarGrupo = element; //guarda el cliente
              }
              else
              {
                //console.log(auxiliarGrupo);
                if(auxiliarGrupo.grupoCliente != element.grupoCliente) //ya se tiene guardado el cliente
                {
                    var range = yAxis.makeDataItem({
                                "category": auxiliarGrupo.nombre,
                                "endCategory": auxiliarGrupo.nombre,
                     });
                     yAxis.createAxisRange(range);
                    
                     var label = range.get("label");
                     
                     label.setAll({
                       text: auxiliarGrupo.grupoCliente,
                       dx: -100,
                       dy:-50,
                       fontWeight: "bold",
                       tooltipText: auxiliarGrupo.grupoCliente,
                       rotation:270  });
                     
                     var tick = range.get("tick");
                     tick.setAll({ visible: true, strokeOpacity: 1, length: 50, location: 1 });
                     
                    var grid = range.get("grid");
                    grid.setAll({ strokeOpacity: 1 });
                    //auxiliarGrupo = element;
                 }
              }
           }
 }

chart.colors.step = 2;
chart.fontSize = 11;
chart.innerRadius = am4core.percent(10);

// define data fields
chart.dataFields.value = "value";
chart.dataFields.name = "name";
chart.dataFields.children = "children";

// this makes labels to be hidden if they don't fit
level0SeriesTemplate.labels.template.truncate = true;
level0SeriesTemplate.labels.template.hideOversized = true;

level0SeriesTemplate.labels.template.adapter.add("rotation", function(rotation, target) {
  target.maxWidth = target.dataItem.slice.radius - target.dataItem.slice.innerRadius - 10;
  target.maxHeight = Math.abs(target.dataItem.slice.arc * (target.dataItem.slice.innerRadius + target.dataItem.slice.radius) / 2 * am4core.math.RADIANS);
  return rotation;
})


var level0SeriesTemplate = new am4plugins_sunburst.SunburstSeries();
level0SeriesTemplate.hiddenInLegend = false;
chart.seriesTemplates.setKey("0", level0SeriesTemplate)

//Nivel hijo 1
var level1SeriesTemplate = level0SeriesTemplate.clone();
chart.seriesTemplates.setKey("1", level1SeriesTemplate)
level1SeriesTemplate.fillOpacity = 0.75;
level1SeriesTemplate.hiddenInLegend = true;

//Nivel hijo 2
var level2SeriesTemplate = level0SeriesTemplate.clone();
chart.seriesTemplates.setKey("2", level2SeriesTemplate)
level2SeriesTemplate.fillOpacity = 0.5;
level2SeriesTemplate.hiddenInLegend = true;

//Leyenda de las categorias
chart.legend = new am4charts.Legend();
  },

  beforeDestroy() {
    if (this.chart) {
      this.chart.dispose();
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.hello {
  width: 100%;
  height: 500px;
}
</style>


<template>
  <div class="hello" ref="chartdiv">
  </div>
</template>
