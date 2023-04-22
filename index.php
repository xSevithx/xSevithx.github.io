<!DOCTYPE html>
<html>
<head>
  <title>ERC Total Supply Example</title>
  <script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
</head>
<body>
  <h1>ERC Total Supply Example</h1>
  <div id="output"></div>

  <script>
    // Create a new instance of Web3 with Ankr's RPC endpoint
    const web3 = new Web3('https://rpc-mainnet.ankr.network');

    // The contract address for the ERC token
    const contractAddress = '0xc8faF90F8fcA363E261d8d1892A31a636aA1ef5C';

    // The ABI for the ERC token contract
    const abi = [
      {
        "constant":true,
        "inputs":[],
        "name":"totalSupply",
        "outputs":[{"name":"","type":"uint256"}],
        "payable":false,
        "stateMutability":"view",
        "type":"function"
      }
    ];

    // Create a new instance of the ERC token contract
    const ercContract = new web3.eth.Contract(abi, contractAddress);

    // Call the totalSupply() function on the ERC token contract
    ercContract.methods.totalSupply().call().then(totalSupply => {
      // Convert the total supply from wei to ETH
      const totalSupplyEth = web3.utils.fromWei(totalSupply, 'ether');

      // Output the total supply
      const outputDiv = document.getElementById('output');
      outputDiv.innerHTML = `Total Supply: ${totalSupplyEth} ETH`;
    }).catch(error => {
      console.error(error);
    });
  </script>
</body>
</html>
