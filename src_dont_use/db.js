import Dexie from 'dexie';

const db = new Dexie('MyDatabase');
db.version(1).stores({ items: '++id, name, order, image, updated_at, created_at' });

export default db;