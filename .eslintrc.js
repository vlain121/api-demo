module.exports = {
    'env': {
        'browser': true,
        'es2021': true,
    },
    'extends': [
        'plugin:vue/essential',
        'google',
    ],
    'parserOptions': {
        'ecmaVersion': 13,
        'sourceType': 'module',
    },
    'plugins': [
        'vue',
    ],
    'rules': {
        'max-len': ['error', {'code': 120, 'ignoreComments': true, 'ignoreStrings': true}],
        'quotes': ['error', 'single'],
        'camelcase': 0,
        'semi': ['error', 'never'],
        'indent': ['error', 4],
    },
}
