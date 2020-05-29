<!DOCTYPE HTML>
<html>

<head>
<script src="https://cdn.plot.ly/plotly-latest.min.js">
</script>
</head>
<body>

<div id="myDiv" style="height: 370px; width: 50%;"></div>
<div id="myDiv1" style="height: 370px; width: 50%;"></div>
<h1>hello</h1>

<script>
  var xValue = ['Product A', 'Product B', 'Product C'];

  var yValue = [20, 14, 23];

    var trace1 = {
    x: xValue,
    y: yValue,
    type: 'bar',
    text: yValue.map(String),
    textposition: 'auto',
    hoverinfo: 'none',
    marker: {
        color: 'rgb(158,202,225)',
        opacity: 0.6,
        line: {
        color: 'rgb(8,48,107)',
        width: 1.5
        }
    }
    };

var data = [trace1];

var layout = {
  title: 'January 2013 Sales Report'
};

Plotly.newPlot('myDiv', data, layout, {staticPlot: true});
Plotly.newPlot('myDiv1', data, layout, {staticPlot: true});
</script>
</body>
</html> 