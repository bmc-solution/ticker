<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allowed HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allowed headers
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dynamic Ticker</title>
	<style>
	body {
		font-family: Arial, sans-serif;
	}
	
	.ticker {
		display: flex;
		overflow: hidden;
		white-space: nowrap;
		background-color: #f0f0f0;
		border: 1px solid #ddd;
		padding: 10px;
	}
	
	.ticker-item {
		margin-right: 20px;
		animation: scroll 10s linear infinite;
	}
	
	@keyframes scroll {
		from {
			transform: translateX(100%);
		}
		to {
			transform: translateX(-100%);
		}
	}
	</style>
</head>

<body>
	<h1>Dynamic Stock Ticker</h1>
	<div class="ticker" id="ticker"> Loading data... </div>
	<script>
	const apiUrl = "https://api.mg-link.net/api/Data/GetLocalIndices";
	const username = "junaid@mettisglobal.com";
	const password = "jun@mg258";
	async function fetchData() {
		try {
			const response = await fetch(`${apiUrl}?username=${username}&userpassword=${password}`);
			if(!response.ok) {
				throw new Error(`API error: ${response.status}`);
			}
			const data = await response.json();
			updateTicker(data);
		} catch(error) {
			console.error("Error fetching data:", error);
			document.getElementById("ticker").textContent = "Failed to load data.";
		}
	}

	function updateTicker(data) {
		const ticker = document.getElementById("ticker");
		ticker.innerHTML = ""; // Clear existing items
		data.forEach(item => {
			const tickerItem = document.createElement("span");
			tickerItem.className = "ticker-item";
			tickerItem.textContent = `${item.name}: ${item.value} (${item.change}%)`;
			ticker.appendChild(tickerItem);
		});
	}
	// Fetch data when the page loads
	document.addEventListener("DOMContentLoaded", fetchData);
	</script>
</body>

</html>