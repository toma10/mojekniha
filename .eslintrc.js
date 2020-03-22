module.exports = {
  root: false,
  parserOptions: {
    ecmaVersion: 6
  },
  env: {
    browser: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:vue/recommended',
  ],
  rules: {
    'indent': ['error', 2],
    'quotes': ['error', 'single'],
    'semi': ['error', 'never'],
    'comma-dangle': ['error', 'always-multiline'],
    'vue/require-default-prop': 0,
  }
}
