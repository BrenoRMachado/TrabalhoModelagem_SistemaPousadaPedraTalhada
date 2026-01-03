/**
 * GERENCIADOR DE ESTADO DOS QUARTOS
 * Pousada Pedra Talhada
 * 
 * Gerencia o status dos quartos (disponível, ocupado, manutenção)
 * Usa localStorage para persistência durante a sessão
 */

const RoomManager = {
    // Estados possíveis
    STATUS: {
        AVAILABLE: 'available',
        OCCUPIED: 'occupied',
        MAINTENANCE: 'maintenance'
    },

    // Inicializar quartos padrão (se não existir no localStorage)
    initializeRooms() {
        const existing = localStorage.getItem('pousada_rooms');
        
        // Esperamos exatamente estes quartos por padrão (15 quartos: 101..115)
        const expectedRooms = [];
        for (let i = 101; i <= 115; i++) expectedRooms.push(String(i));

        if (!existing) {
            // Gerar 15 quartos (101..115) com alguns estados iniciais
            const defaultRooms = {};
            const occupied = ['102','107','110','113','302'];
            const maintenance = ['103','108','114'];
            for (let i = 101; i <= 115; i++) {
                const key = String(i);
                let status = this.STATUS.AVAILABLE;
                let guest = null;
                let type = 'Standard';

                if (occupied.includes(key)) {
                    status = this.STATUS.OCCUPIED;
                    guest = 'Hóspede Exemplo';
                } else if (maintenance.includes(key)) {
                    status = this.STATUS.MAINTENANCE;
                }

                // Simple type heuristic by floor
                if (i >= 201 && i < 300) type = 'Duplo';
                if (i >= 300) type = 'Suíte';

                defaultRooms[key] = { status, type, guest };
            }

            localStorage.setItem('pousada_rooms', JSON.stringify(defaultRooms));
            return defaultRooms;
        }
        
        // Se já existe, validar que os quartos correspondem ao conjunto esperado.
        try {
            const parsed = JSON.parse(existing);
            const keys = Object.keys(parsed || {});

            const hasAllExpected = expectedRooms.every(k => keys.includes(k));
            // Se não tem todos os quartos esperados ou tem chaves estranhas, re-criar estados padrão
            if (!hasAllExpected || keys.length !== expectedRooms.length) {
                // Recriar defaultRooms (mesma lógica acima)
                const defaultRooms = {};
                const occupied = ['102','107','110','113','302'];
                const maintenance = ['103','108','114'];
                for (let i = 101; i <= 115; i++) {
                    const key = String(i);
                    let status = this.STATUS.AVAILABLE;
                    let guest = null;
                    let type = 'Standard';

                    if (occupied.includes(key)) {
                        status = this.STATUS.OCCUPIED;
                        guest = 'Hóspede Exemplo';
                    } else if (maintenance.includes(key)) {
                        status = this.STATUS.MAINTENANCE;
                    }

                    if (i >= 201 && i < 300) type = 'Duplo';
                    if (i >= 300) type = 'Suíte';

                    defaultRooms[key] = { status, type, guest };
                }

                localStorage.setItem('pousada_rooms', JSON.stringify(defaultRooms));
                return defaultRooms;
            }

            // Caso os dados estejam ok, retorná-los
            return parsed;
        } catch (e) {
            // Se parse falhar, recriar defaults
            const defaultRooms = {};
            const occupied = ['102','107','110','113','302'];
            const maintenance = ['103','108','114'];
            for (let i = 101; i <= 115; i++) {
                const key = String(i);
                let status = this.STATUS.AVAILABLE;
                let guest = null;
                let type = 'Standard';

                if (occupied.includes(key)) {
                    status = this.STATUS.OCCUPIED;
                    guest = 'Hóspede Exemplo';
                } else if (maintenance.includes(key)) {
                    status = this.STATUS.MAINTENANCE;
                }

                if (i >= 201 && i < 300) type = 'Duplo';
                if (i >= 300) type = 'Suíte';

                defaultRooms[key] = { status, type, guest };
            }

            localStorage.setItem('pousada_rooms', JSON.stringify(defaultRooms));
            return defaultRooms;
        }
    },

    // Obter todos os quartos
    getAllRooms() {
        return JSON.parse(localStorage.getItem('pousada_rooms') || '{}');
    },

    // Obter quarto específico
    getRoom(roomNumber) {
        const rooms = this.getAllRooms();
        return rooms[roomNumber];
    },

    // Atualizar status do quarto
    updateRoomStatus(roomNumber, status, guestName = null) {
        const rooms = this.getAllRooms();
        
        if (rooms[roomNumber]) {
            rooms[roomNumber].status = status;
            rooms[roomNumber].guest = guestName;
            localStorage.setItem('pousada_rooms', JSON.stringify(rooms));
            
            console.log(`✅ Quarto ${roomNumber} atualizado para ${status}`);
            return true;
        }
        
        console.error(`❌ Quarto ${roomNumber} não encontrado`);
        return false;
    },

    // Marcar quarto como ocupado (quando criar reserva)
    occupyRoom(roomNumber, guestName) {
        return this.updateRoomStatus(roomNumber, this.STATUS.OCCUPIED, guestName);
    },

    // Marcar quarto como disponível (quando fazer checkout)
    releaseRoom(roomNumber) {
        return this.updateRoomStatus(roomNumber, this.STATUS.AVAILABLE, null);
    },

    // Marcar quarto como manutenção
    maintenanceRoom(roomNumber) {
        return this.updateRoomStatus(roomNumber, this.STATUS.MAINTENANCE, null);
    },

    // Obter classe CSS baseado no status
    getStatusClass(status) {
        switch(status) {
            case this.STATUS.AVAILABLE:
                return 'available';
            case this.STATUS.OCCUPIED:
                return 'occupied';
            case this.STATUS.MAINTENANCE:
                return 'maintenance';
            default:
                return 'available';
        }
    },

    // Obter ícone baseado no status
    getStatusIcon(status) {
        switch(status) {
            case this.STATUS.AVAILABLE:
                return 'meeting_room';
            case this.STATUS.OCCUPIED:
                return 'person';
            case this.STATUS.MAINTENANCE:
                return 'build';
            default:
                return 'meeting_room';
        }
    },

    // Obter texto do status
    getStatusText(status) {
        switch(status) {
            case this.STATUS.AVAILABLE:
                return 'Disponível';
            case this.STATUS.OCCUPIED:
                return 'Ocupado';
            case this.STATUS.MAINTENANCE:
                return 'Manutenção';
            default:
                return 'Disponível';
        }
    },

    // Resetar todos os quartos para estado padrão
    resetRooms() {
        localStorage.removeItem('pousada_rooms');
        this.initializeRooms();
        console.log('🔄 Quartos resetados para estado padrão');
    },

    // Obter estatísticas
    getStatistics() {
        const rooms = this.getAllRooms();
        const stats = {
            total: Object.keys(rooms).length,
            available: 0,
            occupied: 0,
            maintenance: 0
        };

        Object.values(rooms).forEach(room => {
            if (room.status === this.STATUS.AVAILABLE) stats.available++;
            else if (room.status === this.STATUS.OCCUPIED) stats.occupied++;
            else if (room.status === this.STATUS.MAINTENANCE) stats.maintenance++;
        });

        stats.occupancyRate = Math.round((stats.occupied / stats.total) * 100);

        return stats;
    }
};

// Inicializar quartos ao carregar o script
document.addEventListener('DOMContentLoaded', function() {
    RoomManager.initializeRooms();
    console.log('🏨 Sistema de Gerenciamento de Quartos Inicializado');
    console.log(RoomManager.getAllRooms());
});
