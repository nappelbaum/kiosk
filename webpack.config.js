const config = {
  mode: "production",
  entry: {
    header: "./src/js/header.js",
    main: "./src/js/main.js",
    item: "./src/js/item.js",
  },
  output: {
    filename: "[name].bundle.js",
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ["style-loader", "css-loader"],
      },
    ],
  },
};

module.exports = config;
