  <script>
  import * as am4core from "@amcharts/amcharts4/core";
  import * as am4charts from "@amcharts/amcharts4/charts";
  import am4themes_animated from "@amcharts/amcharts4/themes/animated";
  
  am4core.useTheme(am4themes_animated);
  
  export default {
    props:{
       data:Object
    },

    mounted() {
      let chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
      
      console.log(this.data);

      let newData = [];

      for (let index = 0; index < this.data.length; index++) 
      {
        let newObject = {};
        const element = this.data[index];
         for (let propiedad in element) 
         {
           let fecha = propiedad;
           //console.log(fecha);
           let datosFecha = element[propiedad];
           //console.log(element[propiedad]);  
           for(let dato in datosFecha)
           {
             //console.log(datosFecha[dato].requeridos)
             newObject.date = fecha;
             newObject.asistieron = datosFecha[dato].asistieron;
             newData.push(newObject);
           }        
         }
      }

      console.log(newData);
      
      // Add data
      chart.data = newData;

    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    //dateAxis.renderer.grid.template.location = 0;
    //dateAxis.renderer.minGridDistance = 30;
    
    var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis1.title.text = "Personal";
    
    var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis2.title.text = "$";
    valueAxis2.renderer.opposite = true;
    valueAxis2.renderer.grid.template.disabled = true;
    
    // Create series
    var series1 = chart.series.push(new am4charts.ColumnSeries());
    series1.dataFields.valueY = "asistieron";
    series1.dataFields.dateX = "date";
    series1.yAxis = valueAxis1;
    series1.name = "Asistencias";
    series1.tooltipText = "{name}\n[bold font-size: 20]${valueY}M[/]";
    series1.fill = chart.colors.getIndex(0);
    series1.strokeWidth = 0;
    series1.clustered = false;
    series1.columns.template.width = am4core.percent(40);
    
    var series2 = chart.series.push(new am4charts.ColumnSeries());
    series2.dataFields.valueY = "sales2";
    series2.dataFields.dateX = "date";
    series2.yAxis = valueAxis1;
    series2.name = "Requeridos";
    series2.tooltipText = "{name}\n[bold font-size: 20]${valueY}M[/]";
    series2.fill = chart.colors.getIndex(0).lighten(0.5);
    series2.strokeWidth = 0;
    series2.clustered = false;
    series2.toBack();
    
    var series3 = chart.series.push(new am4charts.LineSeries());
    series3.dataFields.valueY = "market1";
    series3.dataFields.dateX = "date";
    series3.name = "Faltas";
    series3.strokeWidth = 2;
    series3.tensionX = 0.7;
    series3.yAxis = valueAxis2;
    series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
    
    var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
    bullet3.circle.radius = 3;
    bullet3.circle.strokeWidth = 2;
    bullet3.circle.fill = am4core.color("#fff");
    
    var series4 = chart.series.push(new am4charts.LineSeries());
    series4.dataFields.valueY = "market2";
    series4.dataFields.dateX = "date";
    series4.name = "$";
    series4.strokeWidth = 2;
    series4.tensionX = 0.7;
    series4.yAxis = valueAxis2;
    series4.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
    series4.stroke = chart.colors.getIndex(0).lighten(0.5);
    series4.strokeDasharray = "3,3";
    
    var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
    bullet4.circle.radius = 3;
    bullet4.circle.strokeWidth = 2;
    bullet4.circle.fill = am4core.color("#fff");
    
    // Add cursor
    chart.cursor = new am4charts.XYCursor();
    
    // Add legend
    chart.legend = new am4charts.Legend();
    chart.legend.position = "top";
    
    // Add scrollbar
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series1);
    chart.scrollbarX.series.push(series3);
    chart.scrollbarX.parent = chart.bottomAxesContainer;
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
  