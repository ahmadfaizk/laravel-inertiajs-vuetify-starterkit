import md5 from 'crypto-js/md5'

export default function (email) {
  return `https://www.gravatar.com/avatar/${md5(email)}?s=200`
}
